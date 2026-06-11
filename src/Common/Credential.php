<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

use Closure;
use SensitiveParameter;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

/**
 * Immutable holder for a pair of Zenlayer Cloud API credentials.
 *
 * The secret-key password is intentionally NOT stored in a declared property.
 * It lives inside a private closure so that `var_export()`, `var_dump()`,
 * `print_r()`, and exception stack traces cannot reach the plaintext value;
 * `serialize()` is additionally blocked outright by `__serialize()`.
 *
 *     $cred = new Credential('AKID-...', 'SECRET');
 *     var_export($cred);  // → no SECRET in output
 *     var_dump($cred);    // → __debugInfo redacts
 *     $cred->secretKeyId;            // readable: public readonly
 *     $cred->getSecretKeyPassword(); // explicit retrieval only
 */
final class Credential implements CredentialInterface
{
    public readonly string $secretKeyId;

    private readonly Closure $secret;

    public function __construct(
        string $secretKeyId,
        #[SensitiveParameter] string $secretKeyPassword,
    ) {
        // Trim surrounding whitespace — a trailing newline in a .env value is
        // a common footgun that otherwise produces a cryptic 401 (the byte is
        // signed but the server's stored key has no newline). Matches the
        // upstream Python SDK's credential handling.
        $secretKeyId = trim($secretKeyId);
        $secretKeyPassword = trim($secretKeyPassword);

        if ($secretKeyId === '' || $secretKeyPassword === '') {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING,
                'SecretKeyId or SecretKeyPassword is missing.',
            );
        }

        $this->secretKeyId = $secretKeyId;
        $this->secret = static fn (): string => $secretKeyPassword;
    }

    public function getSecretKeyId(): string
    {
        return $this->secretKeyId;
    }

    /**
     * Retrieve the secret-key password. Callers should pass the result
     * straight into the signing call; do not log it.
     */
    public function getSecretKeyPassword(): string
    {
        return ($this->secret)();
    }

    /**
     * HMAC credentials never carry a Bearer token.
     */
    public function getToken(): ?string
    {
        return null;
    }

    /**
     * Redact the closure when var_dump / print_r enumerate this object.
     *
     * @return array{secretKeyId:string, secretKeyPassword:string}
     */
    public function __debugInfo(): array
    {
        return [
            'secretKeyId' => $this->secretKeyId,
            'secretKeyPassword' => '*** redacted ***',
        ];
    }

    /**
     * Block serialization entirely — there is no safe way to round-trip a
     * Credential through a string. Force callers to reconstruct from the
     * original Laravel config values.
     */
    public function __serialize(): array
    {
        throw new ZenlayerCloudSdkException(
            ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
            'Credential is not serializable.',
        );
    }
}
