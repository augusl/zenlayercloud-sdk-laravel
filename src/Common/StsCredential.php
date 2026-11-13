<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use Closure;
use SensitiveParameter;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

/**
 * Temporary AccessKey credentials issued by AssumeRole. The security token
 * is sent as x-zc-security-token and included in the HMAC signature.
 * Credentials are supplied by the caller; this class does not refresh them.
 */
final class StsCredential implements SecurityTokenCredentialInterface
{
    private readonly Credential $credential;

    private readonly Closure $securityToken;

    public function __construct(
        string $secretKeyId,
        #[SensitiveParameter] string $secretKeyPassword,
        #[SensitiveParameter] string $securityToken,
    ) {
        $this->credential = new Credential($secretKeyId, $secretKeyPassword);
        if (trim($securityToken) === '') {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING,
                'SecurityToken must not be empty.',
            );
        }

        // Keep the token out of property dumps, including var_export().
        $this->securityToken = static fn (): string => $securityToken;
    }

    public function getSecretKeyId(): string
    {
        return $this->credential->getSecretKeyId();
    }

    public function getSecretKeyPassword(): string
    {
        return $this->credential->getSecretKeyPassword();
    }

    public function getToken(): ?string
    {
        return null;
    }

    public function getSecurityToken(): string
    {
        return ($this->securityToken)();
    }

    /** @return array{secretKeyId:string,secretKeyPassword:string,securityToken:string} */
    public function __debugInfo(): array
    {
        return [
            'secretKeyId' => $this->getSecretKeyId(),
            'secretKeyPassword' => '*** redacted ***',
            'securityToken' => '*** redacted ***',
        ];
    }

    public function __serialize(): array
    {
        throw new ZenlayerCloudSdkException(
            ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
            'StsCredential is not serializable.',
        );
    }
}
