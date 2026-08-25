<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

final class Config
{
    /** Maximum allowed length of the `x-zc-request-client` header value. */
    public const REQUEST_CLIENT_MAX_LENGTH = 128;

    /**
     * Allowed character set for the `x-zc-request-client` header. Designed
     * to keep the value safe to embed into an HTTP header without any
     * risk of CRLF injection.
     */
    public const REQUEST_CLIENT_PATTERN = '/^[0-9a-zA-Z\-_ ,;.]+$/';

    public readonly string $endpoint;

    public readonly string $scheme;

    public readonly ?string $requestClient;

    public readonly int $rateLimitMaxRetries;

    public readonly int $rateLimitRetryDelayMs;

    public function __construct(
        string $endpoint = 'console.zenlayer.com',
        string $scheme = 'https',
        // Seconds. Raise it (ZENLAYER_TIMEOUT) when provisioning slow
        // resources; most Zenlayer Actions are async/poll-based so 60s is a
        // safer web-request default than the Go SDK's 300s.
        public readonly int $timeout = 60,
        public readonly bool $retry = false,
        public readonly int $retryMax = 3,
        public readonly bool $debug = false,
        public readonly ?string $proxy = null,
        public readonly bool|string $verify = true,
        ?string $requestClient = null,
        int $rateLimitMaxRetries = 3,
        int $rateLimitRetryDelayMs = 1000,
    ) {
        if ($timeout <= 0) {
            throw self::invalid('timeout must be greater than zero.');
        }

        if ($retryMax < 0) {
            throw self::invalid('retry_max must be zero or greater.');
        }

        if ($rateLimitMaxRetries < 0) {
            throw self::invalid('rate_limit_max_retries must be zero or greater.');
        }

        if ($rateLimitRetryDelayMs < 0) {
            throw self::invalid('rate_limit_retry_delay_ms must be zero or greater.');
        }

        if (is_string($verify) && trim($verify) === '') {
            throw self::invalid('verify must be a boolean or a non-empty CA bundle path.');
        }

        [$this->scheme, $this->endpoint] = self::normalizeEndpoint($endpoint, $scheme);
        $this->rateLimitMaxRetries = $rateLimitMaxRetries;
        $this->rateLimitRetryDelayMs = $rateLimitRetryDelayMs;

        $this->requestClient = $requestClient !== null && $requestClient !== ''
            ? self::sanitizeRequestClient($requestClient)
            : null;
    }

    /**
     * Apply the same constraints to the request-client identifier that the
     * Zenlayer Cloud API expects: max 128 characters, and only the
     * characters listed in {@see self::REQUEST_CLIENT_PATTERN}. Trailing
     * over-length input is truncated.
     *
     * Intentional deviation from the upstream SDKs: where they silently log
     * and drop an invalid value, we throw. The value is embedded into an HTTP
     * header, so failing fast prevents CRLF header injection from a
     * misconfigured value rather than silently shipping a broken request.
     */
    private static function sanitizeRequestClient(string $value): string
    {
        if (strlen($value) > self::REQUEST_CLIENT_MAX_LENGTH) {
            $value = substr($value, 0, self::REQUEST_CLIENT_MAX_LENGTH);
        }

        if (preg_match(self::REQUEST_CLIENT_PATTERN, $value) !== 1) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
                'request_client must match '.self::REQUEST_CLIENT_PATTERN
                .' (alphanumerics, space, dash, underscore, comma, semicolon, period only).',
            );
        }

        return $value;
    }

    /**
     * Normalize a bare `host[:port]` or a complete HTTP(S) endpoint. API
     * requests always target `/api/v2/{service}`, so accepting credentials,
     * paths, queries, or fragments here would make the signed Host header and
     * the actual destination disagree.
     *
     * @return array{0:'http'|'https',1:string}
     */
    private static function normalizeEndpoint(string $endpoint, string $scheme): array
    {
        $endpoint = trim($endpoint);
        $scheme = strtolower(trim($scheme));

        if ($endpoint === '') {
            throw self::invalid('endpoint must not be empty.');
        }

        if (preg_match('/[\x00-\x1F\x7F]/', $endpoint) === 1) {
            throw self::invalid('endpoint must not contain control characters.');
        }

        if (str_contains($endpoint, '://')) {
            $parts = parse_url($endpoint);
        } else {
            if (! in_array($scheme, ['http', 'https'], true)) {
                throw self::invalid('scheme must be either http or https.');
            }

            $parts = parse_url($scheme.'://'.$endpoint);
        }

        if ($parts === false || ! isset($parts['scheme'], $parts['host'])) {
            throw self::invalid('endpoint must be a valid host[:port] or HTTP(S) URL.');
        }

        $normalizedScheme = strtolower($parts['scheme']);
        if (! in_array($normalizedScheme, ['http', 'https'], true)) {
            throw self::invalid('endpoint scheme must be either http or https.');
        }

        $path = $parts['path'] ?? '';
        if ($path !== '' && $path !== '/') {
            throw self::invalid('endpoint must not contain a path.');
        }

        foreach (['user', 'pass', 'query', 'fragment'] as $component) {
            if (array_key_exists($component, $parts)) {
                throw self::invalid("endpoint must not contain {$component} information.");
            }
        }

        $host = strtolower($parts['host']);
        if ($host === '' || preg_match('/[\\s\\x00-\\x1F\\x7F]/', $host) === 1) {
            throw self::invalid('endpoint host is invalid.');
        }

        $port = isset($parts['port']) ? ':'.$parts['port'] : '';

        return [$normalizedScheme, $host.$port];
    }

    private static function invalid(string $message): ZenlayerCloudSdkException
    {
        return new ZenlayerCloudSdkException(
            ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
            $message,
        );
    }
}
