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
    ) {
        // Tolerate the common copy-paste shape `https://host/` so the URL
        // builder never produces `https://https://host` or a trailing `//`.
        if (preg_match('#^(https?)://(.+)$#i', $endpoint, $m) === 1) {
            $scheme = $m[1];
            $endpoint = $m[2];
        }
        $this->endpoint = rtrim($endpoint, '/');

        // Anything other than plain "http" falls back to HTTPS.
        $this->scheme = strtolower($scheme) === 'http' ? 'http' : 'https';

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
}
