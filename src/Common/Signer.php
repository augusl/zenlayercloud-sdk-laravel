<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common;

/**
 * Computes the `Authorization` header for Zenlayer Cloud OpenAPI requests.
 *
 * Implements Zenlayer's `ZC2-HMAC-SHA256` signature scheme as specified at
 * https://docs.console.zenlayer.com/api-reference/cn (Authorization v2).
 *
 *  1. Build a canonical request string from the HTTP method, the canonical
 *     URI (always `/`), an empty canonical query string, the signed headers
 *     (`content-type`, `host`), and the SHA-256 hex digest of the request
 *     body.
 *  2. Build the string-to-sign by joining the signing algorithm, the request
 *     timestamp, and the SHA-256 hex digest of the canonical request.
 *  3. Compute the HMAC-SHA-256 of the string-to-sign using the caller's
 *     secret key password as the HMAC key, hex-encoded.
 *
 * The class is stateless and safe to share across requests.
 */
final class Signer
{
    public const ALGORITHM = 'ZC2-HMAC-SHA256';

    public const SIGNED_HEADERS = 'content-type;host';

    /**
     * Produce the value for the `Authorization` HTTP header.
     */
    public function sign(
        string $method,
        string $host,
        string $contentType,
        string $payload,
        int $timestamp,
        string $secretKeyId,
        string $secretKeyPassword,
    ): string {
        $hashedPayload = hash('sha256', $payload);

        // Canonical headers: lowercase keys, trailing \n for each entry. Note
        // that $canonicalHeaders already ends with \n, so the implode("\n", ...)
        // separator after it produces a literal empty line between the headers
        // block and the signed-headers list — byte-for-byte matching Python's
        // `'%s\n%s\n%s\n%s\n%s\n%s'` format.
        $canonicalHeaders = "content-type:{$contentType}\nhost:{$host}\n";

        $canonicalRequest = implode("\n", [
            $method,                  // POST
            '/',                      // canonicalUri
            '',                       // canonicalQueryString (empty for POST)
            $canonicalHeaders,        // ends with \n; the implode separator adds another
            self::SIGNED_HEADERS,
            $hashedPayload,
        ]);

        $hashedCanonical = hash('sha256', $canonicalRequest);

        $stringToSign = self::ALGORITHM."\n{$timestamp}\n{$hashedCanonical}";

        $signature = hash_hmac('sha256', $stringToSign, $secretKeyPassword);

        return sprintf(
            '%s Credential=%s, SignedHeaders=%s, Signature=%s',
            self::ALGORITHM,
            $secretKeyId,
            self::SIGNED_HEADERS,
            $signature,
        );
    }
}
