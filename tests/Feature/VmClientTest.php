<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use ZenlayerCloud\Laravel\Common\AbstractClient;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\CredentialInterface;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Tests\TestCase;
use ZenlayerCloud\Laravel\Vm\V20260401\Models;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;

final class VmClientTest extends TestCase
{
    public function test_describe_zones_sends_correctly_signed_post(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-1234',
                'response' => [
                    'requestId' => 'req-1234',
                    'zoneSet' => [
                        ['zoneId' => 'SEL-A', 'zoneName' => 'Seoul A', 'supportIpv6' => true],
                        ['zoneId' => 'SIN-A', 'zoneName' => 'Singapore A', 'supportIpv6' => false],
                    ],
                ],
            ], 200),
        ]);

        $request = new Models\DescribeZonesRequest;
        $resp = ZenlayerCloud::vm()->DescribeZones($request);

        self::assertInstanceOf(Models\DescribeZonesResponse::class, $resp);
        self::assertSame('req-1234', $resp->requestId);
        self::assertCount(2, $resp->response->zoneSet);
        self::assertSame('SEL-A', $resp->response->zoneSet[0]->zoneId);
        self::assertSame('Singapore A', $resp->response->zoneSet[1]->zoneName);
        self::assertTrue($resp->response->zoneSet[0]->supportIpv6);

        Http::assertSent(function (Request $r) {
            $timestamp = (int) $r->header('x-zc-timestamp')[0];
            $expectedAuthorization = (new Signer)->sign(
                method: 'POST',
                host: 'console.zenlayer.com',
                contentType: 'application/json',
                payload: '{}',
                timestamp: $timestamp,
                secretKeyId: 'AKID-default-test',
                secretKeyPassword: 'SK-default-secret',
            );

            return $r->method() === 'POST'
                && $r->url() === 'https://console.zenlayer.com/api/v2/vm'
                && $r->header('Content-Type')[0] === 'application/json'
                && $r->header('x-zc-action')[0] === 'DescribeZones'
                && $r->header('x-zc-service')[0] === 'vm'
                && $r->header('x-zc-version')[0] === '2026-04-01'
                && $r->header('x-zc-signature-method')[0] === 'ZC2-HMAC-SHA256'
                && $r->header('x-zc-sdk-lang')[0] === 'PHP'
                && str_starts_with($r->header('x-zc-sdk-version')[0], 'SDK_PHP_')
                && $r->header('Authorization')[0] === $expectedAuthorization
                && $r->body() === '{}';
        });
    }

    public function test_token_connection_uses_bearer_auth_without_signing(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-tok',
                'response' => ['requestId' => 'req-tok'],
            ], 200),
        ]);

        ZenlayerCloud::vm('token')->DescribeZones(new Models\DescribeZonesRequest);

        Http::assertSent(function (Request $r) {
            // Bearer auth is used...
            self::assertSame('Bearer PAT-token-test-xyz', $r->header('Authorization')[0]);
            // ...and the HMAC-only headers are absent.
            self::assertSame([], $r->header('x-zc-signature-method'));
            self::assertSame([], $r->header('x-zc-timestamp'));
            // ...while the common headers are still present.
            self::assertSame('DescribeZones', $r->header('x-zc-action')[0]);
            self::assertSame('vm', $r->header('x-zc-service')[0]);

            return true;
        });
    }

    public function test_request_client_header_passes_through_when_configured(): void
    {
        Http::fake([
            'staging.zenlayer.local/*' => Http::response([
                'requestId' => 'req-x',
                'response' => ['requestId' => 'req-x'],
            ], 200),
        ]);

        ZenlayerCloud::vm('staging')->DescribeZones(new Models\DescribeZonesRequest);

        Http::assertSent(function (Request $r) {
            return $r->url() === 'https://staging.zenlayer.local/api/v2/vm'
                && $r->header('x-zc-request-client')[0] === 'tests-suite-1.0';
        });
    }

    public function test_serializes_nested_request_body(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-2',
                'response' => [
                    'requestId' => 'req-2',
                    'orderNumber' => 'ON-1',
                    'instanceIdSet' => ['i-1', 'i-2'],
                ],
            ], 200),
        ]);

        $req = new Models\CreateInstancesRequest;
        $req->zoneId = 'SEL-A';
        $req->imageId = 'IMG-1';
        $req->instanceType = 'S8I';
        $req->instanceCount = 2;
        $req->instanceChargePrepaid = new Models\ChargePrepaid;
        $req->instanceChargePrepaid->period = 12;

        ZenlayerCloud::vm()->CreateInstances($req);

        Http::assertSent(function (Request $r) {
            $decoded = json_decode($r->body(), true);
            self::assertSame('SEL-A', $decoded['zoneId']);
            self::assertSame('IMG-1', $decoded['imageId']);
            self::assertSame(2, $decoded['instanceCount']);
            self::assertSame(['period' => 12], $decoded['instanceChargePrepaid']);
            // Null fields must not appear:
            self::assertArrayNotHasKey('instanceChargePostpaid', $decoded);

            return true;
        });
    }

    public function test_non_200_response_raises_typed_exception(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-err',
                'code' => 'INVALID_PARAMETER',
                'message' => 'ZoneId is required.',
            ], 400),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame('INVALID_PARAMETER', $e->errorCode);
            self::assertSame('req-err', $e->requestId);
            self::assertSame('ZoneId is required.', $e->errorMessage);
            self::assertSame('ZoneId is required.', $e->getErrorMessage());
            self::assertStringContainsString('ZoneId is required.', $e->getMessage());
        }
    }

    public function test_retry_enabled_api_error_still_raises_typed_exception(): void
    {
        Http::fake([
            'staging.zenlayer.local/*' => Http::response([
                'requestId' => 'req-retry-err',
                'code' => 'INVALID_PARAMETER',
                'message' => 'Bad page size.',
            ], 400),
        ]);

        try {
            ZenlayerCloud::vm('staging')->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame('INVALID_PARAMETER', $e->errorCode);
            self::assertSame('req-retry-err', $e->requestId);
            self::assertStringContainsString('Bad page size.', $e->getMessage());
        }

        Http::assertSentCount(1);
    }

    public function test_connection_failure_raises_network_error(): void
    {
        // Laravel 11.0 predates the Http::failedConnection() test helper, so
        // throw the same framework exception directly to keep the package's
        // minimum-version test suite executable.
        Http::fake(function () {
            throw new ConnectionException('DNS lookup failed');
        });

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_NETWORK, $e->errorCode);
            self::assertStringContainsString('DNS lookup failed', $e->getMessage());
        }
    }

    public function test_vm_client_resolves_via_container_type_hint(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response(['requestId' => 'r', 'response' => ['requestId' => 'r']], 200),
        ]);

        $vm = $this->app->make(VmClient::class);
        self::assertInstanceOf(VmClient::class, $vm);

        $vm->DescribeZones(new Models\DescribeZonesRequest);
        Http::assertSentCount(1);
    }

    public function test_200_response_without_code_field_is_treated_as_success(): void
    {
        // Regression guard: a successful Zenlayer Cloud response never carries
        // a top-level `code` field. Earlier versions of this SDK mistakenly
        // treated `code !== 'OK'` as an error on HTTP 200, which broke any
        // payload that happened to nest a field named "code".
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-ok',
                'response' => [
                    'requestId' => 'req-ok',
                    'totalCount' => 0,
                    'dataSet' => [],
                ],
            ], 200),
        ]);

        $resp = ZenlayerCloud::vm()->DescribeInstances(new Models\DescribeInstancesRequest);

        self::assertSame('req-ok', $resp->requestId);
        self::assertSame(0, $resp->response->totalCount);
        self::assertSame([], $resp->response->dataSet);
    }

    public function test_non_200_success_status_is_still_treated_as_error(): void
    {
        // Upstream contract: ONLY 200 is a success. A 204 with empty body must
        // surface as an exception so callers do not assume a parseable body.
        Http::fake([
            'console.zenlayer.com/*' => Http::response('', 204),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_JSON_PARSE, $e->errorCode);
            self::assertStringContainsString('HTTP 204', $e->getMessage());
        }
    }

    public function test_non_200_without_code_field_uses_http_status_not_network_error(): void
    {
        // A non-200 whose JSON body lacks `code` must NOT be labelled
        // NETWORK_ERROR (that means "never reached the server"). We got an
        // HTTP response, so the code falls back to HTTP_<status>.
        Http::fake([
            'console.zenlayer.com/*' => Http::response(['requestId' => 'r', 'message' => 'gateway down'], 503),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame('HTTP_503', $e->errorCode);
            self::assertNotSame(ZenlayerCloudSdkException::ERR_NETWORK, $e->errorCode);
            self::assertStringContainsString('gateway down', $e->getMessage());
        }
    }

    public function test_malformed_error_body_surfaces_as_json_parse_error(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response('<html>gateway timeout</html>', 502),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_JSON_PARSE, $e->errorCode);
            self::assertStringContainsString('HTTP 502', $e->getMessage());
        }
    }

    #[DataProvider('malformedErrorEnvelopeProvider')]
    public function test_malformed_error_envelope_field_types_are_rejected(array $body): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response($body, 400),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_JSON_PARSE, $e->errorCode);
        }
    }

    /** @return array<string,array{array<string,mixed>}> */
    public static function malformedErrorEnvelopeProvider(): array
    {
        return [
            'code is an object' => [[
                'requestId' => 'r',
                'code' => ['nested' => 'INVALID'],
                'message' => 'bad',
            ]],
            'message is a list' => [[
                'requestId' => 'r',
                'code' => 'INVALID',
                'message' => ['bad'],
            ]],
            'request id is numeric' => [[
                'requestId' => 123,
                'code' => 'INVALID',
                'message' => 'bad',
            ]],
        ];
    }

    public function test_malformed_success_body_surfaces_as_json_parse_error(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response('not-json', 200),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_JSON_PARSE, $e->errorCode);
        }
    }

    public function test_connection_failure_is_wrapped_as_network_error(): void
    {
        // Upstream contract: transport-level failures (DNS, refused, TLS,
        // timeout) surface as the typed exception with NETWORK_ERROR — the
        // caller must never need to catch Laravel's ConnectionException.
        $proxy = 'http://proxy-user:proxy-pass@proxy.invalid:8080';
        $this->app['config']->set('zenlayercloud.connections.default.proxy', $proxy);

        Http::fake(function () use ($proxy) {
            throw new ConnectionException("cURL error 7: SK-default-secret failed through {$proxy}");
        });

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_NETWORK, $e->errorCode);
            self::assertStringContainsString('cURL error 7', $e->getMessage());
            self::assertStringNotContainsString('SK-default-secret', $e->getMessage());
            self::assertStringNotContainsString('proxy-pass', $e->getMessage());
            self::assertInstanceOf(ConnectionException::class, $e->getPrevious());
            self::assertStringNotContainsString('SK-default-secret', $e->getPrevious()->getMessage());
            self::assertStringNotContainsString('proxy-pass', $e->getPrevious()->getMessage());
        }
    }

    public function test_transport_redaction_uses_the_exact_rotating_credential_for_the_attempt(): void
    {
        $credential = new class implements CredentialInterface
        {
            public int $secretReads = 0;

            public function getSecretKeyId(): string
            {
                return 'overlap';
            }

            public function getSecretKeyPassword(): string
            {
                $this->secretReads++;

                return 'overlap-long-'.$this->secretReads;
            }

            public function getToken(): ?string
            {
                return null;
            }
        };
        $proxy = 'http://proxy-user:proxy%2Dpass@proxy.invalid:8080';

        Http::fake(function () use ($proxy) {
            throw new ConnectionException(
                "failed with overlap-long-1 / overlap through {$proxy}; user=proxy-user pass=proxy-pass encoded=proxy%2Dpass",
            );
        });

        $client = new VmClient(
            $credential,
            new Config(proxy: $proxy),
            $this->app->make(HttpClientFactory::class),
            $this->app->make(Signer::class),
        );

        try {
            $client->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_NETWORK, $e->errorCode);
            self::assertNotNull($e->getPrevious());
            foreach (['overlap-long-1', 'overlap', $proxy, 'proxy-user', 'proxy-pass', 'proxy%2Dpass'] as $secret) {
                self::assertStringNotContainsString($secret, $e->getMessage());
                self::assertStringNotContainsString($secret, $e->getPrevious()->getMessage());
            }
        }

        self::assertSame(1, $credential->secretReads, 'Redaction must not re-read a rotating credential.');
    }

    public function test_invalid_utf8_request_is_wrapped_before_any_http_request(): void
    {
        Http::fake();
        $request = new Models\CreateInstancesRequest;
        $request->password = "\xB1\x31";

        try {
            ZenlayerCloud::vm()->CreateInstances($request);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_INVALID_REQUEST, $e->errorCode);
            self::assertInstanceOf(\JsonException::class, $e->getPrevious());
        }

        Http::assertNothingSent();
    }

    public function test_invalid_nested_model_list_is_wrapped_before_any_http_request(): void
    {
        Http::fake();
        $request = new Models\CreateInstancesRequest;
        $request->dataDisks = [['diskSize' => 100]];

        try {
            ZenlayerCloud::vm()->CreateInstances($request);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_INVALID_REQUEST, $e->errorCode);
            self::assertInstanceOf(\TypeError::class, $e->getPrevious());
        }

        Http::assertNothingSent();
    }

    public function test_http_errors_are_never_retried_even_with_retry_enabled(): void
    {
        // The 'staging' connection enables retry (retry_max 5). An HTTP 400
        // must NOT be retried — Actions like CreateInstances are not
        // idempotent. Rate-limit responses are the only HTTP errors that the
        // official SDK contract retries.
        Http::fake([
            'staging.zenlayer.local/*' => Http::response([
                'requestId' => 'r',
                'code' => 'INVALID_PARAMETER',
                'message' => 'bad request',
            ], 400),
        ]);

        try {
            ZenlayerCloud::vm('staging')->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame('INVALID_PARAMETER', $e->errorCode);
        }

        Http::assertSentCount(1);
    }

    public function test_rate_limit_response_is_retried_until_success(): void
    {
        $attempts = 0;
        Http::fake(function () use (&$attempts) {
            $attempts++;
            if ($attempts < 3) {
                return Http::response([
                    'requestId' => 'rate-'.$attempts,
                    'code' => ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED,
                    'message' => 'Too many requests.',
                ], 429);
            }

            return Http::response(['requestId' => 'ok', 'response' => ['requestId' => 'ok']], 200);
        });

        $response = ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);

        self::assertSame('ok', $response->requestId);
        self::assertSame(3, $attempts);
    }

    public function test_rate_limit_retry_rebuilds_hmac_authentication(): void
    {
        $credential = new class implements CredentialInterface
        {
            public int $secretReads = 0;

            public function getSecretKeyId(): string
            {
                return 'AKID-retry-test';
            }

            public function getSecretKeyPassword(): string
            {
                $this->secretReads++;

                return 'SK-retry-test-'.$this->secretReads;
            }

            public function getToken(): ?string
            {
                return null;
            }
        };

        Http::fakeSequence()
            ->push([
                'requestId' => 'limited',
                'code' => ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED,
                'message' => 'Slow down.',
            ], 429)
            ->push(['requestId' => 'ok', 'response' => ['requestId' => 'ok']], 200);

        $client = new VmClient(
            $credential,
            new Config(rateLimitMaxRetries: 1, rateLimitRetryDelayMs: 0),
            $this->app->make(HttpClientFactory::class),
            $this->app->make(Signer::class),
        );
        $client->DescribeZones(new Models\DescribeZonesRequest);

        self::assertSame(2, $credential->secretReads, 'Every physical retry must be signed independently.');
    }

    public function test_rate_limit_delay_honours_retry_after_seconds(): void
    {
        $client = new VmClient(
            new Credential('key', 'secret'),
            new Config(rateLimitRetryDelayMs: 250),
            $this->app->make(HttpClientFactory::class),
            $this->app->make(Signer::class),
        );
        $method = new \ReflectionMethod(
            AbstractClient::class,
            'rateLimitDelayMilliseconds',
        );

        self::assertSame(250, $method->invoke($client, 0, null));
        self::assertSame(4000, $method->invoke($client, 4, null));
        self::assertSame(7000, $method->invoke($client, 1, '7'));
        self::assertSame(500, $method->invoke($client, 1, 'not-seconds'));
        self::assertSame(500, $method->invoke($client, 1, '-1'));
    }

    public function test_request_limit_error_code_is_retried_even_without_http_429(): void
    {
        Http::fakeSequence()
            ->push([
                'requestId' => 'limited',
                'code' => ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED,
                'message' => 'Slow down.',
            ], 503)
            ->push(['requestId' => 'ok', 'response' => ['requestId' => 'ok']], 200);

        $response = ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);

        self::assertSame('ok', $response->requestId);
        Http::assertSentCount(2);
    }

    public function test_rate_limit_retry_exhaustion_preserves_api_error(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'limited-final',
                'code' => ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED,
                'message' => 'Still limited.',
            ], 429),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED, $e->errorCode);
            self::assertSame('limited-final', $e->requestId);
        }

        Http::assertSentCount(4); // first request + three official-default retries
    }

    public function test_rate_limit_retries_can_be_disabled(): void
    {
        $this->app['config']->set('zenlayercloud.connections.default.rate_limit_max_retries', 0);
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'limited-once',
                'code' => ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED,
                'message' => 'No retry.',
            ], 429),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_RATE_LIMIT_EXCEEDED, $e->errorCode);
        }

        Http::assertSentCount(1);
    }

    public function test_cloudflare_security_challenge_has_dedicated_error(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response(
                '<html>challenge</html>',
                403,
                ['cf-mitigated' => 'challenge'],
            ),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_SECURITY_CHALLENGE, $e->errorCode);
            self::assertNull($e->requestId);
        }
    }

    public function test_http_451_has_dedicated_request_blocked_error(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response('<html>blocked</html>', 451),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_REQUEST_BLOCKED, $e->errorCode);
        }
    }

    #[DataProvider('invalidSuccessEnvelopeProvider')]
    public function test_invalid_success_envelope_is_rejected(mixed $body): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response($body, 200),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_JSON_PARSE, $e->errorCode);
            self::assertStringContainsString('Response shape mismatch', $e->getMessage());
        }
    }

    /** @return array<string,array{mixed}> */
    public static function invalidSuccessEnvelopeProvider(): array
    {
        return [
            'top-level list' => [[]],
            'missing response' => [['requestId' => 'r']],
            'response is list' => [['requestId' => 'r', 'response' => ['unexpected-item']]],
            'response is null' => [['requestId' => 'r', 'response' => null]],
        ];
    }

    public function test_connection_failures_are_retried_when_retry_enabled(): void
    {
        // 'staging' has retry_max 5 → up to 6 attempts. Fail twice with a
        // network error, succeed on the third attempt.
        $attempts = 0;
        Http::fake(function () use (&$attempts) {
            $attempts++;
            if ($attempts < 3) {
                throw new ConnectionException('cURL error 28: Operation timed out');
            }

            return Http::response(['requestId' => 'r', 'response' => ['requestId' => 'r']], 200);
        });

        $resp = ZenlayerCloud::vm('staging')->DescribeZones(new Models\DescribeZonesRequest);

        self::assertSame('r', $resp->requestId);
        self::assertSame(3, $attempts);
    }

    public function test_response_type_mismatch_surfaces_as_json_parse_error(): void
    {
        // zoneId is declared ?string; an int violates the documented schema
        // and must surface as the JSON-parse error code — not a raw TypeError.
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-mismatch',
                'response' => [
                    'requestId' => 'req-mismatch',
                    'zoneSet' => [['zoneId' => 12345]],
                ],
            ], 200),
        ]);

        try {
            ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_JSON_PARSE, $e->errorCode);
            self::assertSame('req-mismatch', $e->requestId);
        }
    }

    public function test_scalar_list_item_type_mismatch_surfaces_as_json_parse_error(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-list-mismatch',
                'response' => [
                    'requestId' => 'req-list-mismatch',
                    'instanceIdSet' => ['i-valid', 12345],
                ],
            ], 200),
        ]);

        try {
            ZenlayerCloud::vm()->CreateInstances(new Models\CreateInstancesRequest);
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_JSON_PARSE, $e->errorCode);
            self::assertSame('req-list-mismatch', $e->requestId);
        }
    }

    public function test_describe_instances_status_deserializes_instance_status(): void
    {
        // Regression guard for the regenerated InstanceStatus model. An earlier
        // generated tree modelled InstanceStatus with status-value properties
        // ($PENDING, $RUNNING, ...) instead of {instanceId, instanceStatus},
        // so this dataSet would have silently dropped both real fields.
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-st',
                'response' => [
                    'requestId' => 'req-st',
                    'totalCount' => 2,
                    'dataSet' => [
                        ['instanceId' => 'i-1', 'instanceStatus' => 'RUNNING'],
                        ['instanceId' => 'i-2', 'instanceStatus' => 'STOPPED'],
                    ],
                ],
            ], 200),
        ]);

        $resp = ZenlayerCloud::vm()->DescribeInstancesStatus(new Models\DescribeInstancesStatusRequest);

        self::assertSame(2, $resp->response->totalCount);
        self::assertInstanceOf(Models\InstanceStatus::class, $resp->response->dataSet[0]);
        self::assertSame('i-1', $resp->response->dataSet[0]->instanceId);
        self::assertSame('RUNNING', $resp->response->dataSet[0]->instanceStatus);
        self::assertSame('STOPPED', $resp->response->dataSet[1]->instanceStatus);
    }

    public function test_unknown_response_fields_are_ignored_forward_compat(): void
    {
        // Forward-compat: when Zenlayer Cloud adds new fields to a response,
        // the SDK must accept and ignore them — never throw on unknown keys.
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-fwd',
                'futureFieldAddedByUpstream' => 'should-be-ignored',
                'response' => [
                    'requestId' => 'req-fwd',
                    'zoneSet' => [
                        ['zoneId' => 'SEL-A', 'someNewFieldFromV2' => 'ignored'],
                    ],
                    'unknownNestedField' => ['arbitrary' => 'data'],
                ],
            ], 200),
        ]);

        $resp = ZenlayerCloud::vm()->DescribeZones(new Models\DescribeZonesRequest);

        // Known fields are populated:
        self::assertSame('req-fwd', $resp->requestId);
        self::assertSame('SEL-A', $resp->response->zoneSet[0]->zoneId);
    }

    public function test_full_create_instance_round_trip_with_nested_models(): void
    {
        // Functional smoke test: build a request with nested ChargePrepaid +
        // SystemDisk + DataDisk[], send it through the SDK, decode the
        // response with nested arrays. Verifies the whole request/response
        // model pipeline end-to-end.
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-create',
                'response' => [
                    'requestId' => 'req-create',
                    'orderNumber' => 'ON-100',
                    'instanceIdSet' => ['i-001', 'i-002'],
                    'instances' => [
                        ['instanceId' => 'i-001', 'diskIdSet' => ['d-1', 'd-2']],
                        ['instanceId' => 'i-002', 'diskIdSet' => ['d-3']],
                    ],
                ],
            ], 200),
        ]);

        $req = new Models\CreateInstancesRequest;
        $req->zoneId = 'SEL-A';
        $req->imageId = 'IMG-1';
        $req->instanceType = 'S8I';
        $req->instanceCount = 2;
        $req->instanceChargeType = 'PREPAID';
        $req->instanceChargePrepaid = new Models\ChargePrepaid;
        $req->instanceChargePrepaid->period = 12;
        $req->systemDisk = new Models\SystemDisk;
        $req->systemDisk->diskSize = 50;
        $d1 = new Models\DataDisk;
        $d1->diskSize = 100;
        $d1->diskCategory = 'Basic NVMe SSD';
        $req->dataDisks = [$d1];

        $resp = ZenlayerCloud::vm()->CreateInstances($req);

        self::assertSame('ON-100', $resp->response->orderNumber);
        self::assertSame(['i-001', 'i-002'], $resp->response->instanceIdSet);
        self::assertCount(2, $resp->response->instances);
        self::assertInstanceOf(Models\DiskWithInstance::class, $resp->response->instances[0]);
        self::assertSame('i-001', $resp->response->instances[0]->instanceId);
        self::assertSame(['d-1', 'd-2'], $resp->response->instances[0]->diskIdSet);
        self::assertSame('i-002', $resp->response->instances[1]->instanceId);

        // Verify the sent body round-tripped the nested data correctly:
        Http::assertSent(function (Request $r) {
            $body = json_decode($r->body(), true);
            self::assertSame('SEL-A', $body['zoneId']);
            self::assertSame(['period' => 12], $body['instanceChargePrepaid']);
            self::assertSame(['diskSize' => 50], $body['systemDisk']);
            self::assertCount(1, $body['dataDisks']);
            self::assertSame('Basic NVMe SSD', $body['dataDisks'][0]['diskCategory']);

            return true;
        });
    }
}
