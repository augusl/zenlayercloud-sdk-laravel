<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use Illuminate\Http\Client\ConnectionException;
use JsonException;
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
    public const SDK_VERSION = '0.1.0';

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
    protected function call(string $action, AbstractModel $request, string $responseClass): AbstractModel
    {
        $payload = $request->toJson();
        $host = $this->config->endpoint;

        $headers = [
            'Content-Type' => 'application/json',
            'Host' => $host,
            'x-zc-version' => $this->apiVersion(),
            'x-zc-action' => $action,
            'x-zc-service' => $this->service(),
            'x-zc-sdk-version' => 'SDK_PHP_'.self::SDK_VERSION,
            'x-zc-sdk-lang' => self::SDK_LANG,
        ];

        // Two authentication modes, matching the upstream SDKs: a Bearer token
        // takes precedence and skips signing; otherwise sign with the AccessKey
        // pair (which also adds the timestamp + signature-method headers).
        $token = $this->credential->getToken();
        if ($token !== null) {
            $headers['Authorization'] = 'Bearer '.$token;
        } else {
            $timestamp = time();
            $headers['x-zc-signature-method'] = Signer::ALGORITHM;
            $headers['x-zc-timestamp'] = (string) $timestamp;
            $headers['Authorization'] = $this->signer->sign(
                method: 'POST',
                host: $host,
                contentType: 'application/json',
                payload: $payload,
                timestamp: $timestamp,
                secretKeyId: $this->credential->getSecretKeyId(),
                secretKeyPassword: $this->credential->getSecretKeyPassword(),
            );
        }

        if ($this->config->requestClient !== null && $this->config->requestClient !== '') {
            $headers['x-zc-request-client'] = $this->config->requestClient;
        }

        $url = $this->config->scheme.'://'.$host.'/api/v2/'.$this->service();

        try {
            $httpResponse = $this->http->build($this->config)
                ->withHeaders($headers)
                ->withBody($payload, 'application/json')
                ->post($url);
        } catch (ConnectionException $e) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_NETWORK,
                sprintf('Failed to send request: %s', $e->getMessage()),
                null,
                $e,
            );
        }

        // Zenlayer Cloud OpenAPI reports failure via the HTTP status code.
        // Only status 200 is treated as success; everything else is parsed
        // as an error envelope `{requestId, code, message}`. A successful
        // 200 response never carries a top-level `code` field, so we must
        // not probe $body['code'] on the success branch — payload may have
        // its own nested field named "code".
        $rawBody = (string) $httpResponse->body();

        if ($httpResponse->status() !== 200) {
            throw $this->buildException($httpResponse->status(), $rawBody);
        }

        try {
            $body = (array) json_decode($rawBody, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('Failed to parse response body as JSON: %s', $e->getMessage()),
                null,
                $e,
            );
        }

        /** @var TResp $response */
        $response = new $responseClass;

        try {
            $response->fromArray($body);
        } catch (TypeError $e) {
            // The API returned a value whose type contradicts the documented
            // schema (e.g. an int where a string is declared). Surface it as
            // a parse failure rather than leaking a raw TypeError.
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('Response shape mismatch for %s: %s', $responseClass, $e->getMessage()),
                isset($body['requestId']) ? (string) $body['requestId'] : null,
                $e,
            );
        }

        return $response;
    }

    /**
     * Build a {@see ZenlayerCloudSdkException} from a non-200 HTTP response.
     * If the body cannot be parsed as the expected error envelope we still
     * surface a typed exception, but with the JSON-parse error code so the
     * caller can distinguish transport-level failures from API-level ones.
     */
    private function buildException(int $status, string $rawBody): ZenlayerCloudSdkException
    {
        try {
            $body = (array) json_decode($rawBody, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_JSON_PARSE,
                sprintf('HTTP %d with non-JSON body (%d bytes): %s', $status, strlen($rawBody), $e->getMessage()),
                null,
                $e,
            );
        }

        // Real Zenlayer error envelopes always carry a `code`. If one is
        // missing, fall back to an HTTP-status code rather than reusing
        // ERR_NETWORK — that constant means "the request never reached the
        // server", which is not the case here (we got an HTTP response).
        return new ZenlayerCloudSdkException(
            (string) ($body['code'] ?? 'HTTP_'.$status),
            (string) ($body['message'] ?? sprintf('HTTP %d (no message)', $status)),
            isset($body['requestId']) ? (string) $body['requestId'] : null,
        );
    }
}
