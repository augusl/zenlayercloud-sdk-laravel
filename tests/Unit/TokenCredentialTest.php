<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\CredentialInterface;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\TokenCredential;

final class TokenCredentialTest extends TestCase
{
    public function test_exposes_token_and_empty_key_pair(): void
    {
        $c = new TokenCredential('tok-abc');

        self::assertInstanceOf(CredentialInterface::class, $c);
        self::assertSame('tok-abc', $c->getToken());
        self::assertSame('', $c->getSecretKeyId());
        self::assertSame('', $c->getSecretKeyPassword());
    }

    public function test_trims_whitespace(): void
    {
        self::assertSame('tok-abc', (new TokenCredential("  tok-abc\n"))->getToken());
    }

    public function test_throws_on_empty_token(): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);

        new TokenCredential('   ');
    }

    public function test_hmac_credential_reports_null_token(): void
    {
        $c = new Credential('AKID-x', 'SK-y');

        self::assertNull($c->getToken());
        self::assertSame('AKID-x', $c->getSecretKeyId());
    }

    public function test_var_export_does_not_leak_token(): void
    {
        $c = new TokenCredential('SUPER-SECRET-TOKEN');

        self::assertStringNotContainsString('SUPER-SECRET-TOKEN', var_export($c, true));
    }

    public function test_var_dump_redacts_token(): void
    {
        $c = new TokenCredential('SUPER-SECRET-TOKEN');

        ob_start();
        var_dump($c);
        $out = (string) ob_get_clean();

        self::assertStringNotContainsString('SUPER-SECRET-TOKEN', $out);
        self::assertStringContainsString('*** redacted ***', $out);
    }

    public function test_serialize_is_blocked(): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);

        serialize(new TokenCredential('tok'));
    }
}
