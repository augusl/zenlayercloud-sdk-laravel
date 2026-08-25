<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

final class ConfigTest extends TestCase
{
    public function test_defaults(): void
    {
        $c = new Config;

        self::assertSame('console.zenlayer.com', $c->endpoint);
        self::assertSame('https', $c->scheme);
        self::assertSame(60, $c->timeout);
        self::assertFalse($c->retry);
        self::assertSame(3, $c->retryMax);
        self::assertSame(3, $c->rateLimitMaxRetries);
        self::assertSame(1000, $c->rateLimitRetryDelayMs);
        self::assertFalse($c->debug);
        self::assertNull($c->proxy);
        self::assertNull($c->requestClient);
    }

    public function test_named_arguments(): void
    {
        $c = new Config(
            endpoint: 'api.example.com',
            scheme: 'http',
            timeout: 120,
            retry: true,
            retryMax: 7,
            debug: true,
            proxy: 'http://proxy.local:3128',
            requestClient: 'my-app-1.0',
            rateLimitMaxRetries: 5,
            rateLimitRetryDelayMs: 250,
        );

        self::assertSame('api.example.com', $c->endpoint);
        self::assertSame('http', $c->scheme);
        self::assertSame(120, $c->timeout);
        self::assertTrue($c->retry);
        self::assertSame(7, $c->retryMax);
        self::assertTrue($c->debug);
        self::assertSame('http://proxy.local:3128', $c->proxy);
        self::assertSame('my-app-1.0', $c->requestClient);
        self::assertSame(5, $c->rateLimitMaxRetries);
        self::assertSame(250, $c->rateLimitRetryDelayMs);
    }

    public function test_request_client_empty_string_is_normalized_to_null(): void
    {
        $c = new Config(requestClient: '');

        self::assertNull($c->requestClient);
    }

    public function test_request_client_is_truncated_to_128_characters(): void
    {
        $long = str_repeat('a', 200);
        $c = new Config(requestClient: $long);

        self::assertSame(128, strlen((string) $c->requestClient));
    }

    public function test_request_client_rejects_invalid_characters(): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);
        $this->expectExceptionMessage('request_client must match');

        // CRLF would enable header injection — must fail loudly.
        new Config(requestClient: "abc\r\nX-Injected: 1");
    }

    public function test_request_client_accepts_allowed_punctuation(): void
    {
        $c = new Config(requestClient: 'app_v1.2-rc.3, build-42; release.candidate');

        self::assertSame('app_v1.2-rc.3, build-42; release.candidate', $c->requestClient);
    }

    public function test_scheme_is_normalized_and_invalid_scheme_is_rejected(): void
    {
        self::assertSame('https', (new Config(scheme: 'HTTPS'))->scheme);
        self::assertSame('http', (new Config(scheme: 'HTTP'))->scheme);

        try {
            new Config(scheme: 'ftp');
            self::fail('Expected invalid scheme exception.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CONFIG_INVALID, $e->errorCode);
        }
    }

    public function test_complete_endpoint_url_is_safely_normalized(): void
    {
        $config = new Config(endpoint: ' HTTP://API.Example.COM:8080/ ');

        self::assertSame('http', $config->scheme);
        self::assertSame('api.example.com:8080', $config->endpoint);
    }

    #[DataProvider('invalidEndpointProvider')]
    public function test_invalid_endpoint_shapes_are_rejected(string $endpoint): void
    {
        try {
            new Config(endpoint: $endpoint);
            self::fail("Expected endpoint [{$endpoint}] to be rejected.");
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CONFIG_INVALID, $e->errorCode);
        }
    }

    /** @return array<string,array{string}> */
    public static function invalidEndpointProvider(): array
    {
        return [
            'empty' => ['  '],
            'path' => ['console.zenlayer.com/api/v2/vm'],
            'query' => ['console.zenlayer.com?debug=1'],
            'fragment' => ['console.zenlayer.com#fragment'],
            'credentials' => ['https://user:password@console.zenlayer.com'],
            'unsupported scheme' => ['ftp://console.zenlayer.com'],
            'header injection' => ["console.zenlayer.com\r\nX-Injected: 1"],
        ];
    }

    /** @param array<string,int> $arguments */
    #[DataProvider('invalidNumericConfigProvider')]
    public function test_invalid_numeric_configuration_is_rejected(array $arguments): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);

        new Config(...$arguments);
    }

    /** @return array<string,array{array<string,int>}> */
    public static function invalidNumericConfigProvider(): array
    {
        return [
            'zero timeout' => [['timeout' => 0]],
            'negative network retries' => [['retryMax' => -1]],
            'negative rate limit retries' => [['rateLimitMaxRetries' => -1]],
            'negative rate limit delay' => [['rateLimitRetryDelayMs' => -1]],
        ];
    }

    public function test_verify_defaults_to_true_and_accepts_path_or_false(): void
    {
        self::assertTrue((new Config)->verify);
        self::assertSame('/etc/ssl/zenlayer-ca.pem', (new Config(verify: '/etc/ssl/zenlayer-ca.pem'))->verify);
        self::assertFalse((new Config(verify: false))->verify);
    }

    public function test_empty_verify_path_is_rejected(): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);
        $this->expectExceptionMessage('non-empty CA bundle path');

        new Config(verify: '  ');
    }
}
