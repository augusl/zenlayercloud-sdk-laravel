<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ZenlayerCloud\Laravel\Common\Signer;

final class SignerTest extends TestCase
{
    /**
     * Golden vectors for the Zenlayer Cloud `ZC2-HMAC-SHA256` signature
     * algorithm. Each fixture pins:
     *
     *   - the inputs (method, host, content-type, payload, timestamp, key);
     *   - the SHA-256 hex digest of the payload (computed by the algorithm);
     *   - the resulting `Authorization` header value.
     *
     * The expected hex digests and signatures are intentionally hard-coded.
     * They were computed once by re-implementing the algorithm step-by-step
     * (canonical request → string-to-sign → HMAC-SHA-256) and committed here
     * as a regression fixture. Any drift in {@see Signer::sign()} — even a
     * single missing newline in the canonical request — will surface on the
     * next test run.
     *
     * To verify a vector by hand, run:
     *
     *     php -r '
     *         $hp = hash("sha256", "{}");
     *         $cr = "POST\n/\n\ncontent-type:application/json\nhost:console.zenlayer.com\n\ncontent-type;host\n{$hp}";
     *         $s  = "ZC2-HMAC-SHA256\n1700000000\n" . hash("sha256", $cr);
     *         echo hash_hmac("sha256", $s, "ZL-SECRET-PWD-deadbeef-1234"), PHP_EOL;
     *     '
     */
    public static function goldenVectorProvider(): array
    {
        return [
            'describe_zones_empty_payload' => [[
                'method' => 'POST',
                'host' => 'console.zenlayer.com',
                'content_type' => 'application/json',
                'payload' => '{}',
                'timestamp' => 1700000000,
                'secret_key_id' => 'AKIDtest-key-id-0001',
                'secret_key_password' => 'ZL-SECRET-PWD-deadbeef-1234',
                'expected_payload_sha256' => '44136fa355b3678a1146ad16f7e8649e94fb4fc21fe77e8310c060f61caaff8a',
                'expected_authorization' => 'ZC2-HMAC-SHA256 Credential=AKIDtest-key-id-0001, SignedHeaders=content-type;host, Signature=2b3f42e101002bafea1f414aa9c7fe8a13d52a3fa27d92a3f338b22685ec7884',
            ]],
            'official_docs_bmc_payload' => [[
                'method' => 'POST',
                'host' => 'console.zenlayer.com',
                'content_type' => 'application/json; charset=utf-8',
                'payload' => '{"pageSize":10,"pageNum":1,"zoneId":"HKG-A"}',
                'timestamp' => 1673361177,
                'secret_key_id' => '0D9UtpyKYcHxms5v',
                'secret_key_password' => 'Gu5t9xGARNpq86cd98joQYCN3',
                'expected_payload_sha256' => '5f714687ba91c606d503467766151206392474accd137ffea6dce2420b67c29a',
                'expected_authorization' => 'ZC2-HMAC-SHA256 Credential=0D9UtpyKYcHxms5v, SignedHeaders=content-type;host, Signature=efb356c32e55c781e10dc676da59462c22596d82e91c57803666243379555b2f',
            ]],
            'create_instance_full_payload' => [[
                'method' => 'POST',
                'host' => 'console.zenlayer.com',
                'content_type' => 'application/json',
                'payload' => '{"zoneId":"SEL-A","imageId":"IMG-12345","instanceType":"S8I","instanceCount":2,"internetMaxBandwidthOut":100,"instanceChargePrepaid":{"period":12},"dataDisks":[{"diskSize":100,"diskCategory":"Basic NVMe SSD"}]}',
                'timestamp' => 1705501234,
                'secret_key_id' => 'AKID-full-test',
                'secret_key_password' => 'longer-secret-here-9876543210',
                'expected_payload_sha256' => '5a1867bd6e5da40be76ceab6cfbc3b959b6f8150f1b14013644b0824fa126f36',
                'expected_authorization' => 'ZC2-HMAC-SHA256 Credential=AKID-full-test, SignedHeaders=content-type;host, Signature=a308d57bae86769b7f2c5f9140185033c982a009af7e2644f0ae88794592070e',
            ]],
            'custom_host_unicode_payload' => [[
                'method' => 'POST',
                'host' => 'api.example.zenlayer.local',
                'content_type' => 'application/json',
                'payload' => '{"instanceName":"测试-实例-001","comment":"Includes / and = chars"}',
                'timestamp' => 1731234567,
                'secret_key_id' => 'AKID-unicode',
                'secret_key_password' => 'pwd-unicode-中文-9999',
                'expected_payload_sha256' => 'ed8ae2fd7e284d6db3de1b25e89ef86d167db75107b76a5a23fae68a28b2431a',
                'expected_authorization' => 'ZC2-HMAC-SHA256 Credential=AKID-unicode, SignedHeaders=content-type;host, Signature=b39884f06e3cbeff6119e96ad89d69085bf986c8a4b7069737f8c0722eb097f8',
            ]],
        ];
    }

    #[DataProvider('goldenVectorProvider')]
    public function test_payload_hash_matches_expected(array $vector): void
    {
        // Sanity check that our committed fixture is internally consistent.
        // If hash('sha256') ever drifts (it won't), every signature would also
        // be wrong — this short-circuits to a clearer failure message.
        self::assertSame(
            $vector['expected_payload_sha256'],
            hash('sha256', $vector['payload']),
        );
    }

    #[DataProvider('goldenVectorProvider')]
    public function test_sign_matches_golden_vector(array $vector): void
    {
        $actual = (new Signer)->sign(
            method: $vector['method'],
            host: $vector['host'],
            contentType: $vector['content_type'],
            payload: $vector['payload'],
            timestamp: $vector['timestamp'],
            secretKeyId: $vector['secret_key_id'],
            secretKeyPassword: $vector['secret_key_password'],
        );

        self::assertSame($vector['expected_authorization'], $actual);
    }

    public function test_constants_match_documented_protocol(): void
    {
        self::assertSame('ZC2-HMAC-SHA256', Signer::ALGORITHM);
        self::assertSame('content-type;host', Signer::SIGNED_HEADERS);
    }

    public function test_signer_is_deterministic_for_identical_inputs(): void
    {
        $signer = new Signer;
        $args = ['POST', 'console.zenlayer.com', 'application/json', '{}', 1700000000, 'k', 's'];

        self::assertSame(
            $signer->sign(...$args),
            $signer->sign(...$args),
        );
    }
}
