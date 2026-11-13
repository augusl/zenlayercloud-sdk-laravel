<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ZenlayerCloud\Laravel\Common\CredentialInterface;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\SecurityTokenCredentialInterface;
use ZenlayerCloud\Laravel\Common\StsCredential;

final class StsCredentialTest extends TestCase
{
    public function test_exposes_temporary_keys_and_the_original_security_token(): void
    {
        $credential = new StsCredential('STS.key', 'temporary-password', 'zst_AbC-def_123');

        self::assertInstanceOf(CredentialInterface::class, $credential);
        self::assertInstanceOf(SecurityTokenCredentialInterface::class, $credential);
        self::assertSame('STS.key', $credential->getSecretKeyId());
        self::assertSame('temporary-password', $credential->getSecretKeyPassword());
        self::assertSame('zst_AbC-def_123', $credential->getSecurityToken());
        self::assertNull($credential->getToken());
    }

    #[DataProvider('missingCredentialProvider')]
    public function test_all_three_credential_values_are_required(string $key, string $password, string $token): void
    {
        try {
            new StsCredential($key, $password, $token);
            self::fail('Expected missing credential error.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING, $e->errorCode);
        }
    }

    /** @return array<string,array{string,string,string}> */
    public static function missingCredentialProvider(): array
    {
        return [
            'key' => ['', 'private-password', 'private-token'],
            'password' => ['STS.key', '', 'private-token'],
            'token' => ['STS.key', 'private-password', ''],
            'blank token' => ['STS.key', 'private-password', '   '],
        ];
    }

    public function test_debug_and_export_do_not_expose_either_secret(): void
    {
        $credential = new StsCredential('STS.key', 'private-sts-password', 'private-sts-token');
        ob_start();
        var_dump($credential);
        $dump = (string) ob_get_clean();

        foreach ([$dump, print_r($credential, true), var_export($credential, true)] as $output) {
            self::assertStringNotContainsString('private-sts-password', $output);
            self::assertStringNotContainsString('private-sts-token', $output);
        }
        self::assertSame('{}', json_encode($credential, JSON_THROW_ON_ERROR));
    }

    public function test_serialization_is_blocked(): void
    {
        $this->expectException(ZenlayerCloudSdkException::class);

        serialize(new StsCredential('STS.key', 'private-password', 'private-token'));
    }
}
