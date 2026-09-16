<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Tests\TestCase;
use ZenlayerCloud\Laravel\Zec\V20250901\Models;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

final class ZecClientTest extends TestCase
{
    public function test_describe_zones_via_zec_client(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-zec-1',
                'response' => [
                    'requestId' => 'req-zec-1',
                    'zoneSet' => [['zoneId' => 'SEL-A']],
                ],
            ], 200),
        ]);

        $resp = ZenlayerCloud::zec()->DescribeZones(new Models\DescribeZonesRequest);

        self::assertSame('req-zec-1', $resp->requestId);
        self::assertSame('SEL-A', $resp->response->zoneSet[0]->zoneId);

        Http::assertSent(function (Request $r) {
            return $r->method() === 'POST'
                && $r->url() === 'https://console.zenlayer.com/api/v2/zec'
                && $r->header('x-zc-action')[0] === 'DescribeZones'
                && $r->header('x-zc-service')[0] === 'zec'
                && $r->header('x-zc-version')[0] === '2025-09-01';
        });
    }

    public function test_zec_client_via_type_hint(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response(['requestId' => 'r', 'response' => ['requestId' => 'r']], 200),
        ]);

        $zec = $this->app->make(ZecClient::class);
        self::assertInstanceOf(ZecClient::class, $zec);

        $zec->DescribeVpcs(new Models\DescribeVpcsRequest);
        Http::assertSentCount(1);
    }

    public function test_instance_type_filters_are_preserved(): void
    {
        Http::fake(['*' => Http::response(['response' => ['dataSet' => [], 'totalCount' => 0]], 200)]);
        $payload = ['instanceType' => 'z2a.cpu.1', 'instanceTypeSeries' => 'z2a'];

        ZenlayerCloud::zec()->DescribeInstances((new Models\DescribeInstancesRequest)->fromArray($payload));

        Http::assertSent(fn (Request $request): bool => $request->data() === $payload);
        self::assertSame('{}', (new Models\DescribeInstancesRequest)->toJson());
    }

    #[DataProvider('ipv6QuantityProvider')]
    public function test_ipv6_price_quantity_is_preserved_without_overriding_server_default(?int $amount): void
    {
        Http::fake(['*' => Http::response(['response' => ['bandwidthPrice' => ['unitPrice' => 1.5]]], 200)]);

        $response = ZenlayerCloud::zec()->InquiryPricePublicIpv6(
            (new Models\InquiryPricePublicIpv6Request)->fromArray(['regionId' => 'asia-east-1', 'amount' => $amount]),
        );

        $expected = ['regionId' => 'asia-east-1'];
        if ($amount !== null) {
            $expected['amount'] = $amount;
        }
        Http::assertSent(fn (Request $request): bool => $request->data() === $expected);
        self::assertSame(1.5, $response->response->bandwidthPrice->unitPrice);
    }

    /** @return array<string,array{?int}> */
    public static function ipv6QuantityProvider(): array
    {
        return ['server default' => [null], 'one address' => [1], 'multiple addresses' => [3]];
    }

    public function test_create_byo_asn_preserves_four_byte_asn_and_verification_details(): void
    {
        $payload = [
            'byoAsnId' => 'byoasn-test',
            'asn' => 4294967295,
            'status' => 'VERIFYING',
            'verifyCode' => '62610:831522',
            'exportDeclaration' => 'export: to AS62610 action community .= {62610:831522}; announce AS4294967295',
        ];
        Http::fake(['*' => Http::response(['requestId' => 'byo-request', 'response' => $payload], 200)]);

        $response = ZenlayerCloud::zec()->CreateByoAsn(
            (new Models\CreateByoAsnRequest)->fromArray(['asn' => 4294967295]),
        );

        self::assertSame('byo-request', $response->requestId);
        self::assertSame($payload, $response->response->toArray());
        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://console.zenlayer.com/api/v2/zec'
            && $request->header('x-zc-action')[0] === 'CreateByoAsn'
            && $request->header('x-zc-service')[0] === 'zec'
            && $request->header('x-zc-version')[0] === '2025-09-01'
            && $request->body() === '{"asn":4294967295}');
    }

    public function test_describe_byo_asns_hydrates_nested_resources(): void
    {
        Http::fake(['*' => Http::response(['response' => [
            'totalCount' => 1,
            'dataSet' => [[
                'byoAsnId' => 'byoasn-test',
                'asn' => 4294967295,
                'status' => 'AVAILABLE',
                'ipv4CidrCount' => 0,
                'ipv6CidrCount' => 1,
                'resourceGroup' => ['resourceGroupId' => 'rg-test'],
            ]],
        ]], 200)]);

        $response = ZenlayerCloud::zec()->DescribeByoAsns(new Models\DescribeByoAsnsRequest);
        $item = $response->response->dataSet[0];

        self::assertSame(1, $response->response->totalCount);
        self::assertInstanceOf(Models\ByoAsnInfo::class, $item);
        self::assertSame(4294967295, $item->asn);
        self::assertSame(0, $item->ipv4CidrCount);
        self::assertInstanceOf(Models\ResourceGroupInfo::class, $item->resourceGroup);
        self::assertSame('rg-test', $item->resourceGroup->resourceGroupId);
    }

    public function test_usable_asns_hydrates_integer_list_including_four_byte_values(): void
    {
        Http::fake(['*' => Http::response(['response' => ['asns' => [12340, 4294967295]]], 200)]);

        $response = ZenlayerCloud::zec()->DescribeUsableByoAsns(new Models\DescribeUsableByoAsnsRequest);

        self::assertSame([12340, 4294967295], $response->response->asns);
        Http::assertSent(fn (Request $request): bool => $request->body() === '{}');
    }

    public function test_usable_asns_rejects_string_values_in_integer_list(): void
    {
        Http::fake(['*' => Http::response(['response' => ['asns' => ['4294967295']]], 200)]);
        $this->expectException(ZenlayerCloudSdkException::class);
        $this->expectExceptionMessage(ZenlayerCloudSdkException::ERR_JSON_PARSE);

        ZenlayerCloud::zec()->DescribeUsableByoAsns(new Models\DescribeUsableByoAsnsRequest);
    }

    public function test_public_ipv6_list_hydrates_addresses_and_nested_metadata(): void
    {
        Http::fake(['*' => Http::response(['response' => [
            'totalCount' => 1,
            'dataSet' => [[
                'ipv6Id' => 'ipv6-test',
                'ipv6Cidr' => '2001:db8::/96',
                'associatedType' => 'LB',
                'associatedId' => 'lb-test',
                'nicId' => null,
                'trafficPackageSize' => 1.5,
                'bandwidthCluster' => ['bandwidthClusterId' => 'bc-test'],
                'operationInfo' => ['operation' => 'ModifyBandwidth', 'status' => 'OPERATING'],
            ]],
        ]], 200)]);

        $response = ZenlayerCloud::zec()->DescribeIpv6Addresses(
            (new Models\DescribeIpv6AddressesRequest)->fromArray(['associatedIds' => ['lb-test']]),
        );
        $item = $response->response->dataSet[0];

        self::assertInstanceOf(Models\Ipv6AddressInfo::class, $item);
        self::assertSame('2001:db8::/96', $item->ipv6Cidr);
        self::assertNull($item->nicId);
        self::assertSame(1.5, $item->trafficPackageSize);
        self::assertInstanceOf(Models\BandwidthClusterInfo::class, $item->bandwidthCluster);
        self::assertInstanceOf(Models\OperationInfo::class, $item->operationInfo);
        Http::assertSent(fn (Request $request): bool => $request->data() === ['associatedIds' => ['lb-test']]);
    }

    /** @param list<array{ipv6Id:string,errorCode:string,errorMsg:string}> $failures */
    #[DataProvider('ipv6DeletionProvider')]
    public function test_delete_ipv6_preserves_partial_failures_without_throwing_or_retrying(array $failures): void
    {
        Http::fake(['*' => Http::response(['response' => [
            'requestId' => 'ipv6-delete',
            'failedIpv6Addresses' => $failures,
        ]], 200)]);

        $response = ZenlayerCloud::zec()->DeleteIpv6Addresses(
            (new Models\DeleteIpv6AddressesRequest)->fromArray(['ipv6Ids' => ['ipv6-a', 'ipv6-b']]),
        );

        self::assertSame($failures, $response->response->toArray()['failedIpv6Addresses']);
        foreach ($response->response->failedIpv6Addresses as $failure) {
            self::assertInstanceOf(Models\DeleteIpv6AddressesFailedItem::class, $failure);
        }
        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'DeleteIpv6Addresses'
            && $request->data() === ['ipv6Ids' => ['ipv6-a', 'ipv6-b']]);
        Http::assertSentCount(1);
    }

    /** @return array<string,array{list<array{ipv6Id:string,errorCode:string,errorMsg:string}>}> */
    public static function ipv6DeletionProvider(): array
    {
        return [
            'all succeeded' => [[]],
            'partial failure' => [[[
                'ipv6Id' => 'ipv6-b',
                'errorCode' => 'INVALID_NIC_STACK_TYPE_NOT_SUPPORT',
                'errorMsg' => 'The specified NIC stack type does not support this operation.',
            ]]],
        ];
    }
}
