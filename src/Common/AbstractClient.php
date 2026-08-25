<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use Composer\InstalledVersions;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use JsonException;
use SensitiveParameter;
use stdClass;
use TypeError;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;

/**
 * Base class for service-specific clients shipped by this SDK
 * (`VmClient`, `ZecClient`, ...).
 *
 * Subclasses declare the service slug and the API version and let this base
 * class take care of:
 *   - Serializing the request model to JSON.
 *   - Signing the request with `ZC2-HMAC-SHA256`.
 *   - Sending it through Laravel's HTTP client (so test code can intercept
 *     it via `\Illuminate\Support\Facades\Http::fake()`).
 *   - Translating HTTP errors into a typed {@see ZenlayerCloudSdkException}.
 *   - Hydrating the typed response model from the JSON body.
 */
abstract class AbstractClient
{
    private const COMPOSER_PACKAGE = 'augusl/zenlayercloud-laravel-sdk';

    private const NETWORK_RETRY_DELAY_MS = 200;

    /** Fallback used only when Composer cannot report the installed version. */
    public const SDK_VERSION = '0.1.1';

    public const SDK_LANG = 'PHP';

    public function __construct(
        protected readonly CredentialInterface $credential,
        protected readonly Config $config,
        protected readonly HttpClientFactory $http,
        protected readonly Signer $signer,
    ) {}

    abstract protected function service(): string;

    abstract protected function apiVersion(): string;

    /**
     * @template TResp of AbstractModel
     *
     * @param  class-string<TResp>  $responseClass
     * @return TResp
     */
    protected function call(
        string $action,
        #[SensitiveParameter] AbstractModel $request,
        string $responseClass,
    ): AbstractModel {
        try {
            $payload = $request->toJson();
        } catch (JsonException|TypeError $e) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_INVALID_REQUEST,
                sprintf('Failed to serialize %s: %s', $request::class, $e->getMessage()),
                null,
                $e,
            );
        }

        $host = $this->config->endpoint;

        $headers = [
            'Content-Type' => 'application/json',
            'Host' => $host,
            'x-zc-version' => $this->apiVersion(),
            'x-zc-action' => $action,
            'x-zc-service' => $this->service(),
            'x-zc-sdk-version' => 'SDK_PHP_'.$this->sdkVersion(),
            'x-zc-sdk-lang' => self::SDK_LANG,
        ];

        if ($this->config->requestClient !== null && $this->config->requestClient !== '') {
            $headers['x-zc-request-client'] = $this->config->requestClient;
        }

        $url = $this->config->scheme.'://'.$host.'/api/v2/'.$this->service();

        $rateLimitAttempt = 0;
        do {
            $httpResponse = $this->sendWithNetworkRetries($url, $payload, $headers, $host);
            $this->http->logResponse(
                $this->config,
                $httpResponse->status(),
                $this->service(),
                $action,
            );

            $rawBody = (string) $httpResponse->body();
            $rateLimited = $this->isRateLimitResponse($httpResponse->status(), $rawBody);

            if (! $rateLimited || $rateLimitAttempt >= $this->config->rateLimitMaxRetries) {
                break;
            }

            $this->waitBeforeRateLimitRetry($rateLimitAttempt, $httpResponse);
            $rateLimitAttempt++;
        } while (true);

        // Only status 200 is a normal success. Non-200 responses and an
        // exhausted REQUEST_LIMIT_EXCEEDED response are parsed as the error
        // envelope `{requestId, code, message}`.
        if ($httpResponse->status() !== 200 || $rateLimited) {
            throw $this->buildException($httpResponse, $rawBody);
        }

        try {
            $shape = json_decode($rawBody, false, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('Failed to parse response body as JSON: %s', $e->getMessage()),
                null,
                $e,
            );
        }

        if (! $shape instanceof stdClass
            || ! property_exists($shape, 'response')
            || ! $shape->response instanceof stdClass) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('Response shape mismatch for %s: expected a JSON object containing a response object.', $responseClass),
                $shape instanceof stdClass ? $this->stringRequestId($shape->requestId ?? null) : null,
            );
        }

        /** @var TResp $response */
        $response = new $responseClass;

        try {
            // Decode once as objects so `{}` and `[]` remain distinguishable,
            // then let AbstractModel recursively hydrate nested stdClass values.
            $response->fromArray(get_object_vars($shape));
        } catch (TypeError $e) {
            // The API returned a value whose type contradicts the documented
            // schema (e.g. an int where a string is declared). Surface it as
            // a parse failure rather than leaking a raw TypeError.
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('Response shape mismatch for %s: %s', $responseClass, $e->getMessage()),
                $this->stringRequestId($shape->requestId ?? null),
                $e,
            );
        }

        return $response;
    }

    /**
     * Build an exception from a failed HTTP or exhausted rate-limit response.
     * If the body cannot be parsed as the expected error envelope we still
     * surface a typed exception, but with the JSON-parse error code so the
     * caller can distinguish transport-level failures from API-level ones.
     */
    private function buildException(Response $response, string $rawBody): ZenlayerCloudSdkException
    {
        $status = $response->status();

        if ($status === 403 && strtolower((string) $response->header('cf-mitigated')) === 'challenge') {
            return new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_SECURITY_CHALLENGE,
                'Request was intercepted by a security challenge (HTTP 403). This is a network-layer block, not an API error. Contact support if it persists.',
            );
        }

        if ($status === 451) {
            return new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_REQUEST_BLOCKED,
                'Request was blocked by a security policy (HTTP 451). Contact support to investigate.',
            );
        }

        try {
            $body = json_decode($rawBody, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('HTTP %d with non-JSON body (%d bytes): %s', $status, strlen($rawBody), $e->getMessage()),
                null,
                $e,
            );
        }

        if (! is_array($body) || array_is_list($body)) {
            return new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('HTTP %d returned a JSON body that is not an error object.', $status),
            );
        }

        foreach (['code', 'message', 'requestId'] as $field) {
            if (array_key_exists($field, $body) && ! is_string($body[$field])) {
                return new ZenlayerCloudSdkException(
                    ZenlayerCloudSdkException::ERR_JSON_PARSE,
                    sprintf('HTTP %d returned an error object whose %s field is not a string.', $status, $field),
                );
            }
        }

        // Real Zenlayer error envelopes carry a string `code`. If one is
        // missing, fall back to an HTTP-status code rather than reusing
        // ERR_NETWORK — that constant means "the request never reached the
        // server", which is not the case here (we got an HTTP response).
        return new ZenlayerCloudSdkException(
            $body['code'] ?? 'HTTP_'.$status,
            $body['message'] ?? sprintf('HTTP %d (no message)', $status),
            $body['requestId'] ?? null,
        );
    }

    /**
     * Send one logical request, retrying only connection failures. Authentication
     * is rebuilt before every physical attempt so a long retry window can never
     * reuse an expired HMAC timestamp.
     *
     * @param  array<string,string>  $baseHeaders
     */
    private function sendWithNetworkRetries(
        string $url,
        string $payload,
        array $baseHeaders,
        string $host,
    ): Response {
        $attempt = 0;

        do {
            $authentication = $this->authentication($host, $payload);
            $headers = array_merge($baseHeaders, $authentication['headers']);

            try {
                return $this->http->build($this->config)
                    ->withHeaders($headers)
                    ->withBody($payload, 'application/json')
                    ->post($url);
            } catch (ConnectionException $e) {
                if (! $this->config->retry || $attempt >= $this->config->retryMax) {
                    $transportMessage = $this->redactTransportMessage(
                        $e->getMessage(),
                        $authentication['sensitive'],
                    );
                    $previous = $transportMessage === $e->getMessage()
                        ? $e
                        : new ConnectionException($transportMessage, (int) $e->getCode());

                    throw new ZenlayerCloudSdkException(
                        ZenlayerCloudSdkException::ERR_NETWORK,
                        sprintf('Failed to send request: %s', $transportMessage),
                        null,
                        $previous,
                    );
                }

                $attempt++;
                usleep(self::NETWORK_RETRY_DELAY_MS * 1000);
            }
        } while (true);
    }

    /**
     * @return array{headers:array<string,string>,sensitive:list<string>}
     */
    private function authentication(string $host, string $payload): array
    {
        // A Bearer token takes precedence and skips signing, matching both
        // official language SDKs.
        $token = $this->credential->getToken();
        if ($token !== null) {
            if (trim($token) === '') {
                throw new ZenlayerCloudSdkException(
                    ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING,
                    'Token must not be empty.',
                );
            }

            return [
                'headers' => ['Authorization' => 'Bearer '.$token],
                'sensitive' => [$token],
            ];
        }

        $secretKeyId = $this->credential->getSecretKeyId();
        $secretKeyPassword = $this->credential->getSecretKeyPassword();
        if ($secretKeyId === '' || $secretKeyPassword === '') {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING,
                'SecretKeyId or SecretKeyPassword is missing.',
            );
        }

        $timestamp = time();

        return [
            'headers' => [
                'x-zc-signature-method' => Signer::ALGORITHM,
                'x-zc-timestamp' => (string) $timestamp,
                'Authorization' => $this->signer->sign(
                    method: 'POST',
                    host: $host,
                    contentType: 'application/json',
                    payload: $payload,
                    timestamp: $timestamp,
                    secretKeyId: $secretKeyId,
                    secretKeyPassword: $secretKeyPassword,
                ),
            ],
            'sensitive' => [$secretKeyId, $secretKeyPassword],
        ];
    }

    /** @param list<string> $authenticationSecrets */
    private function redactTransportMessage(string $message, array $authenticationSecrets): string
    {
        $sensitive = [$this->config->proxy];
        if ($this->config->proxy !== null) {
            $proxyParts = parse_url($this->config->proxy);
            if (is_array($proxyParts)) {
                foreach (['user', 'pass'] as $part) {
                    if (isset($proxyParts[$part])) {
                        $sensitive[] = $proxyParts[$part];
                        $sensitive[] = rawurldecode($proxyParts[$part]);
                    }
                }
            }
        }

        array_push($sensitive, ...$authenticationSecrets);

        $sensitive = array_values(array_unique(array_filter(
            $sensitive,
            static fn (?string $value): bool => $value !== null && $value !== '',
        )));
        usort($sensitive, static fn (string $left, string $right): int => strlen($right) <=> strlen($left));

        foreach ($sensitive as $value) {
            $message = str_replace($value, '[REDACTED]', $message);
        }

        return $message;
    }

    private function stringRequestId(mixed $value): ?string
    {
        return is_string($value) ? $value : null;
    }

    private function isRateLimitResponse(int $status, string $rawBody): bool
    {
        if ($status === 429) {
            return true;
        }

        // HTTP 200 is the protocol's only success status, so it cannot carry
        // an API error envelope. Returning here also keeps the success body on
        // the single-decode hydration path below.
        if ($status === 200) {
            return false;
        }

        try {
            $body = json_decode($rawBody, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return false;
        }

        return is_array($body)
            && ($body['code'] ?? null) === ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED;
    }

    private function waitBeforeRateLimitRetry(int $attempt, Response $response): void
    {
        $delayMs = $this->rateLimitDelayMilliseconds(
            $attempt,
            $response->header('Retry-After'),
        );
        if ($delayMs === 0) {
            return;
        }

        usleep($delayMs * 1000);
    }

    private function rateLimitDelayMilliseconds(int $attempt, ?string $retryAfter): int
    {
        // Official SDKs default to exponential delays: 1s, 2s, 4s, ... .
        // Cap the shift and multiplication so extreme custom values cannot
        // overflow the integer accepted by usleep().
        $multiplier = 2 ** min($attempt, 30);
        $maxDelayMs = intdiv(PHP_INT_MAX, 1000);
        $delayMs = (int) min($this->config->rateLimitRetryDelayMs * $multiplier, $maxDelayMs);

        // The public API contract requires waiting at least Retry-After seconds
        // when that header is present. It is defined there as a non-negative
        // integer; malformed values fall back to the configured backoff.
        $retryAfter = $retryAfter === null ? null : trim($retryAfter);
        if ($retryAfter !== null && preg_match('/^\d+$/', $retryAfter) === 1) {
            $digits = ltrim($retryAfter, '0');
            $digits = $digits === '' ? '0' : $digits;
            $maxSeconds = (string) intdiv($maxDelayMs, 1000);
            $exceedsMaximum = strlen($digits) > strlen($maxSeconds)
                || (strlen($digits) === strlen($maxSeconds) && strcmp($digits, $maxSeconds) > 0);
            $retryAfterMs = $exceedsMaximum ? $maxDelayMs : (int) $digits * 1000;
            $delayMs = max($delayMs, $retryAfterMs);
        }

        return $delayMs;
    }

    private function sdkVersion(): string
    {
        if (InstalledVersions::isInstalled(self::COMPOSER_PACKAGE)) {
            $version = InstalledVersions::getPrettyVersion(self::COMPOSER_PACKAGE);
            if (is_string($version) && $version !== '') {
                return ltrim($version, 'v');
            }
        }

        return self::SDK_VERSION;
    }
}
