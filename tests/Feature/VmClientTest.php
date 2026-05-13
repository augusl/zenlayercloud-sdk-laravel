<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
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
            return $r->method() === 'POST'
                && $r->url() === 'https://console.zenlayer.com/api/v2/vm'
                && $r->header('x-zc-action')[0] === 'DescribeZones'
                && $r->header('x-zc-service')[0] === 'vm'
                && $r->header('x-zc-version')[0] === '2026-04-01'
                && $r->header('x-zc-signature-method')[0] === 'ZC2-HMAC-SHA256'
                && $r->header('x-zc-sdk-lang')[0] === 'PHP'
                && str_starts_with($r->header('x-zc-sdk-version')[0], 'SDK_PHP_')
                && str_starts_with($r->header('Authorization')[0], 'ZC2-HMAC-SHA256 Credential=AKID-default-test, SignedHeaders=content-type;host, Signature=')
                && $r->body() === '{}';
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
        Http::fake([
            'console.zenlayer.com/*' => Http::failedConnection('DNS lookup failed'),
        ]);

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
