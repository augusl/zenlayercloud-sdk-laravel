<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

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
        );

        self::assertSame('api.example.com', $c->endpoint);
        self::assertSame('http', $c->scheme);
        self::assertSame(120, $c->timeout);
        self::assertTrue($c->retry);
        self::assertSame(7, $c->retryMax);
        self::assertTrue($c->debug);
        self::assertSame('http://proxy.local:3128', $c->proxy);
        self::assertSame('my-app-1.0', $c->requestClient);
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
}
