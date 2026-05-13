<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

final class CredentialTest extends TestCase
{
    public function test_constructs_with_valid_values(): void
    {
        $c = new Credential('AKID-x', 'SK-y');

        self::assertSame('AKID-x', $c->secretKeyId);
        self::assertSame('SK-y', $c->getSecretKeyPassword());
    }

    public function test_var_export_does_not_leak_password(): void
    {
        $c = new Credential('AKID-x', 'ULTRA-SECRET');

        self::assertStringNotContainsString('ULTRA-SECRET', var_export($c, true));
    }

    public function test_var_dump_does_not_leak_password(): void
    {
        $c = new Credential('AKID-x', 'ULTRA-SECRET');

        ob_start();
        var_dump($c);
        $out = (string) ob_get_clean();

        self::assertStringNotContainsString('ULTRA-SECRET', $out);
        self::assertStringContainsString('*** redacted ***', $out);
    }

    public function test_print_r_does_not_leak_password(): void
    {
        $c = new Credential('AKID-x', 'ULTRA-SECRET');

        self::assertStringNotContainsString('ULTRA-SECRET', print_r($c, true));
    }

    public function test_serialize_is_blocked(): void
    {
        $c = new Credential('AKID-x', 'ULTRA-SECRET');

        $this->expectException(ZenlayerCloudSdkException::class);
        serialize($c);
    }

    public function test_throws_on_empty_secret_key_id(): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);
        $this->expectExceptionMessage('SecretKeyId or SecretKeyPassword is missing.');

        new Credential('', 'SK-y');
    }

    public function test_throws_on_empty_secret_key_password(): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);

        new Credential('AKID-x', '');
    }

    public function test_exception_carries_credential_missing_error_code(): void
    {
        try {
            new Credential('', '');
            self::fail('Expected exception');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING, $e->errorCode);
        }
    }
}
