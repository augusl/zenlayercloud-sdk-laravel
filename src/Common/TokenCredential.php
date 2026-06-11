<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use Closure;
use SensitiveParameter;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

/**
 * Bearer-token credential. Authenticates via `Authorization: Bearer <token>`
 * instead of HMAC signing. Generate a personal access token at
 * https://console.zenlayer.com/accessToken.
 *
 * Like {@see Credential}, the token is held inside a closure (never a declared
 * property) so `var_export()`, `var_dump()`, `print_r()`, and `serialize()`
 * cannot surface the plaintext value.
 */
final class TokenCredential implements CredentialInterface
{
    private readonly Closure $token;

    public function __construct(
        #[SensitiveParameter] string $token,
    ) {
        $token = trim($token);
        if ($token === '') {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING,
                'Token must not be empty.',
            );
        }

        $this->token = static fn (): string => $token;
    }

    public function getSecretKeyId(): string
    {
        return '';
    }

    public function getSecretKeyPassword(): string
    {
        return '';
    }

    public function getToken(): string
    {
        return ($this->token)();
    }

    /**
     * @return array{token:string}
     */
    public function __debugInfo(): array
    {
        return ['token' => '*** redacted ***'];
    }

    public function __serialize(): array
    {
        throw new ZenlayerCloudSdkException(
            ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
            'TokenCredential is not serializable.',
        );
    }
}
