<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

/**
 * Common contract for the two authentication modes Zenlayer Cloud supports,
 * mirroring the upstream SDKs' credential interface:
 *
 *   - {@see Credential}      — HMAC request signing (AccessKey id + password).
 *   - {@see TokenCredential} — `Authorization: Bearer <token>` (personal
 *     access token from https://console.zenlayer.com/accessToken).
 *
 * When {@see self::getToken()} returns a non-null value the client uses Bearer
 * auth and skips signing; otherwise it signs with the AccessKey pair.
 */
interface CredentialInterface
{
    public function getSecretKeyId(): string;

    public function getSecretKeyPassword(): string;

    public function getToken(): ?string;
}
