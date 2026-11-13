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

    /** @param array<string,string> $payload */
    #[DataProvider('networkMutationProvider')]
    public function test_new_network_actions_preserve_official_payload_and_response(string $action, array $payload): void
    {
        Http::fake(['*' => Http::response(['requestId' => 'outer-test', 'response' => ['requestId' => 'inner-test']], 200)]);
        $class = 'ZenlayerCloud\\Laravel\\Zec\\V20250901\\Models\\'.$action.'Request';

        $response = ZenlayerCloud::zec()->{$action}((new $class)->fromArray($payload));

        self::assertSame('outer-test', $response->requestId);
        self::assertSame('inner-test', $response->response->requestId);
        Http::assertSent(fn (Request $request): bool => $request->url() === 'https://console.zenlayer.com/api/v2/zec'
            && $request->header('x-zc-action')[0] === $action
            && $request->header('x-zc-service')[0] === 'zec'
            && $request->header('x-zc-version')[0] === '2025-09-01'
            && $request->data() === $payload);
        Http::assertSentCount(1);
    }

    /** @return array<string,array{string,array<string,string>}> */
    public static function networkMutationProvider(): array
    {
        return [
            'associate secondary CIDR' => ['AssociateVpcCidrBlock', ['vpcId' => 'vpc-test', 'cidrBlock' => '10.1.0.0/16']],
            'unassociate secondary CIDR' => ['UnassociateVpcCidrBlock', ['vpcId' => 'vpc-test', 'cidrBlock' => '10.1.0.0/16']],
            'modify interconnect CIDR' => ['ModifyBorderGatewayInterconnectCidr', ['zbgId' => 'zbg-test', 'interConnectCidr' => '169.254.0.0/27']],
        ];
    }

    public function test_vpcs_preserve_primary_and_secondary_cidrs_separately(): void
    {
        Http::fake(['*' => Http::response(['response' => ['totalCount' => 2, 'dataSet' => [
            ['vpcId' => 'vpc-secondary', 'cidrBlock' => '10.0.0.0/16', 'secondaryCidrBlocks' => ['10.1.0.0/16', '10.2.0.0/16']],
            ['vpcId' => 'vpc-primary', 'cidrBlock' => '10.3.0.0/16', 'secondaryCidrBlocks' => []],
        ]]], 200)]);

        $response = ZenlayerCloud::zec()->DescribeVpcs(new Models\DescribeVpcsRequest);

        self::assertInstanceOf(Models\VpcInfo::class, $response->response->dataSet[0]);
        self::assertSame('10.0.0.0/16', $response->response->dataSet[0]->cidrBlock);
        self::assertSame(['10.1.0.0/16', '10.2.0.0/16'], $response->response->dataSet[0]->secondaryCidrBlocks);
        self::assertSame([], $response->response->dataSet[1]->secondaryCidrBlocks);
    }

    public function test_instance_placement_group_and_border_gateway_fields_are_preserved(): void
    {
        Http::fake(['*' => Http::response(['response' => ['requestId' => 'create-test']], 200)]);
        $instance = ['zoneId' => 'SEL-A', 'placementGroupId' => 'pg-test'];
        $gateway = ['regionId' => 'asia-east-1', 'interConnectCidr' => '169.254.0.0/27'];

        ZenlayerCloud::zec()->CreateZecInstances((new Models\CreateZecInstancesRequest)->fromArray($instance));
        ZenlayerCloud::zec()->CreateBorderGateway((new Models\CreateBorderGatewayRequest)->fromArray($gateway));

        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'CreateZecInstances'
            && $request->data() == $instance);
        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'CreateBorderGateway'
            && $request->data() == $gateway);
        self::assertSame('{}', (new Models\CreateZecInstancesRequest)->toJson());
        self::assertSame('{}', (new Models\CreateBorderGatewayRequest)->toJson());
        Http::assertSentCount(2);
    }

    public function test_border_gateway_editable_flag_preserves_false(): void
    {
        Http::fake(['*' => Http::response(['response' => ['dataSet' => [[
            'zbgId' => 'zbg-test', 'interConnectCidr' => '169.254.0.0/27', 'interconnectCidrEditable' => false,
        ]]]], 200)]);

        $response = ZenlayerCloud::zec()->DescribeBorderGateways(new Models\DescribeBorderGatewaysRequest);
        $gateway = $response->response->dataSet[0];

        self::assertInstanceOf(Models\ZbgInfo::class, $gateway);
        self::assertFalse($gateway->interconnectCidrEditable);
        self::assertSame('169.254.0.0/27', $gateway->interConnectCidr);
    }

    public function test_eip_concurrent_connections_hydrate_float_and_null_metrics(): void
    {
        Http::fake(['*' => Http::response(['response' => [
            'maxValue' => 1.5, 'minValue' => 0, 'avgValue' => 0.5,
            'dataList' => [['time' => '2026-10-17T00:00:00Z', 'value' => 0], ['time' => '2026-10-17T00:01:00Z', 'value' => null]],
        ]], 200)]);
        $payload = ['instanceId' => 'instance-test', 'metricType' => 'CONCURRENT_CONNECTIONS', 'step' => 1];

        $response = ZenlayerCloud::zec()->DescribeEipConcurrentConnsMonitorData(
            (new Models\DescribeEipConcurrentConnsMonitorDataRequest)->fromArray($payload),
        );

        self::assertSame(1.5, $response->response->maxValue);
        self::assertSame(0.0, $response->response->minValue);
        self::assertInstanceOf(Models\MetricValue::class, $response->response->dataList[0]);
        self::assertSame(0.0, $response->response->dataList[0]->value);
        self::assertNull($response->response->dataList[1]->value);
        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'DescribeEipConcurrentConnsMonitorData'
            && $request->data() === $payload);
    }

    public function test_eip_new_connections_hydrate_typed_directional_metrics(): void
    {
        Http::fake(['*' => Http::response(['response' => [
            'allMaxValue' => 1.5, 'allMinValue' => 0, 'inAvgValue' => 0.5, 'outAvgValue' => null,
            'dataList' => [['time' => '2026-10-17T00:00:00Z', 'allValue' => 1.5, 'inValue' => 0, 'outValue' => null]],
        ]], 200)]);
        $payload = ['eipId' => 'eip-test', 'metricType' => 'NEW_CONNECTIONS', 'step' => 5];

        $response = ZenlayerCloud::zec()->DescribeEipNewConnsMonitorData(
            (new Models\DescribeEipNewConnsMonitorDataRequest)->fromArray($payload),
        );

        self::assertSame(1.5, $response->response->allMaxValue);
        self::assertSame(0.0, $response->response->allMinValue);
        self::assertInstanceOf(Models\NewConnsValue::class, $response->response->dataList[0]);
        self::assertSame(0.0, $response->response->dataList[0]->inValue);
        self::assertNull($response->response->dataList[0]->outValue);
        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'DescribeEipNewConnsMonitorData'
            && $request->data() === $payload);
    }

    /**
     * @param  array<string,mixed>  $payload
     * @param  array<string,mixed>  $result
     */
    #[DataProvider('addedActionProvider')]
    public function test_added_actions_preserve_the_official_contract(string $action, array $payload, array $result): void
    {
        Http::fake(['*' => Http::response(['requestId' => 'outer', 'response' => $result + ['requestId' => 'inner']], 200)]);
        $class = 'ZenlayerCloud\\Laravel\\Zec\\V20250901\\Models\\'.$action.'Request';
        $request = (new $class)->fromArray($payload);

        $response = ZenlayerCloud::zec()->{$action}($request);

        self::assertSame('outer', $response->requestId);
        self::assertEquals($result + ['requestId' => 'inner'], $response->response->toArray());
        Http::assertSent(fn (Request $sent): bool => $sent->url() === 'https://console.zenlayer.com/api/v2/zec'
            && $sent->header('x-zc-action') === [$action]
            && $sent->header('x-zc-version') === ['2025-09-01']
            && $sent->header('x-zc-service') === ['zec']
            && $sent->data() === $payload);
        Http::assertSentCount(1);
        if ($payload === []) {
            self::assertSame('{}', $request->toJson());
        }
        if (isset($payload['netmask'])) {
            self::assertInstanceOf(Models\Ipv6NetmaskInfo::class, $request->netmask);
        }
    }

    /** @return array<string,array{string,array<string,mixed>,array<string,mixed>}> */
    public static function addedActionProvider(): array
    {
        return [
            'grant NIC permission' => ['CreateNetworkInterfacePermission',
                ['nicId' => 'nic-test', 'granteeCid' => '12345', 'permission' => 'INSTANCE_ATTACH'],
                ['permissionId' => 'permission-test']],
            'list NIC permissions' => ['DescribeNetworkInterfacePermissions',
                ['nicIds' => ['nic-test'], 'permissionIds' => ['permission-test'], 'pageSize' => 10, 'pageNum' => 1],
                ['totalCount' => 1, 'dataSet' => [['permissionId' => 'permission-test', 'nicId' => 'nic-test', 'granteeCid' => '12345', 'permission' => 'INSTANCE_ATTACH']]]],
            'delete NIC permission' => ['DeleteNetworkInterfacePermission', ['permissionId' => 'permission-test', 'force' => false], []],
            'IPv6 CIDR price' => ['DescribeIpv6CidrPrice',
                ['regionId' => 'asia-east-1', 'networkLineType' => 'PremiumBGP', 'netmask' => ['netmask' => 64, 'amount' => 2],
                    'instanceChargePostpaid' => ['period' => 1], 'marketingOptions' => ['usePocVoucher' => false]],
                ['cidrPrice' => ['unitPrice' => 1.25]]],
            'rename IPv6 CIDR' => ['ModifyIpv6CidrAttribute', ['cidrId' => 'cidr-test', 'name' => 'test-cidr'], []],
            'purchase IPv6 CIDRs' => ['CreateIpv6Cidr',
                ['regionId' => 'asia-east-1', 'networkLineType' => 'PremiumBGP', 'netmask' => ['netmask' => 64, 'amount' => 2],
                    'subnetMaskLength' => 72, 'instanceChargePostpaid' => ['period' => 1], 'marketingOptions' => ['usePocVoucher' => false]],
                ['cidrIds' => ['cidr-a', 'cidr-b'], 'orderNumber' => 'order-test']],
            'available IPv6 netmasks' => ['DescribeIpv6CidrNetmasks', ['regionId' => 'asia-east-1', 'instanceChargePostpaid' => ['period' => 1]],
                ['netmaskSet' => [['netmask' => 64, 'networkLineTypes' => [['networkLineType' => 'PremiumBGP', 'stock' => 0, 'price' => ['unitPrice' => 1.25]]]]]]],
            'IPv6 CIDR regions' => ['DescribeIpv6CidrRegions', [],
                ['regionSet' => [['discount' => 0.5, 'regionId' => 'asia-east-1', 'location' => 'Shanghai', 'wideRegionName' => 'APAC', 'wideRegionTitle' => 'Asia Pacific']]]],
            'BYOIP region availability' => ['DescribeByoipRegionAvailability', [],
                ['regions' => [['regionId' => 'asia-east-1', 'location' => 'Shanghai', 'lineAvailabilities' => [['network' => 'PremiumBGP', 'status' => 'SUPPORTED']]]]]],
            'batch EIP thresholds' => ['ModifyEipsBlockThreshold',
                ['eipIds' => ['eip-a', 'eip-b'], 'enable' => false, 'bps' => 4294967296, 'pps' => 0, 'inCps' => 0, 'outCps' => 0],
                ['failedEips' => []]],
            'NAT new connections' => ['DescribeNatGatewayNewConnsMonitorData',
                ['natGatewayId' => 'nat-test', 'metricType' => 'NEW_CONNECTIONS', 'startTime' => '2026-11-13T00:00:00Z', 'endTime' => '2026-11-13T00:05:00Z', 'step' => 1],
                ['allMaxValue' => 1.5, 'allMinValue' => 0, 'dataList' => [['time' => '2026-11-13T00:00:00Z', 'allValue' => 1.5, 'inValue' => 0]]]],
        ];
    }

    public function test_new_nested_network_models_are_hydrated(): void
    {
        Http::fakeSequence()
            ->push(['response' => ['netmaskSet' => [['netmask' => 64, 'networkLineTypes' => [['networkLineType' => 'PremiumBGP', 'stock' => 0, 'price' => ['unitPrice' => 1.25]]]]]]])
            ->push(['response' => ['regions' => [['regionId' => 'asia-east-1', 'lineAvailabilities' => [['network' => 'PremiumBGP', 'status' => 'SUPPORTED']]]]]])
            ->push(['response' => ['dataList' => [['time' => '2026-11-13T00:00:00Z', 'allValue' => 1.5, 'inValue' => 0, 'outValue' => null]]]]);

        $netmasks = ZenlayerCloud::zec()->DescribeIpv6CidrNetmasks(new Models\DescribeIpv6CidrNetmasksRequest)->response->netmaskSet;
        self::assertInstanceOf(Models\Ipv6CidrNetmaskInfo::class, $netmasks[0]);
        self::assertInstanceOf(Models\Ipv6CidrLineTypeInfo::class, $netmasks[0]->networkLineTypes[0]);
        self::assertInstanceOf(Models\PriceItem::class, $netmasks[0]->networkLineTypes[0]->price);
        self::assertSame(0, $netmasks[0]->networkLineTypes[0]->stock);
        self::assertSame(1.25, $netmasks[0]->networkLineTypes[0]->price->unitPrice);

        $regions = ZenlayerCloud::zec()->DescribeByoipRegionAvailability(new Models\DescribeByoipRegionAvailabilityRequest)->response->regions;
        self::assertInstanceOf(Models\ByoipRegionAvailability::class, $regions[0]);
        self::assertInstanceOf(Models\ByoipLineAvailability::class, $regions[0]->lineAvailabilities[0]);

        $values = ZenlayerCloud::zec()->DescribeNatGatewayNewConnsMonitorData(new Models\DescribeNatGatewayNewConnsMonitorDataRequest)->response->dataList;
        self::assertInstanceOf(Models\NatNewConnsValue::class, $values[0]);
        self::assertSame(1.5, $values[0]->allValue);
        self::assertSame(0.0, $values[0]->inValue);
        self::assertNull($values[0]->outValue);
    }

    public function test_batch_eip_threshold_failures_are_returned_without_retrying_writes(): void
    {
        Http::fake(['*' => Http::response(['response' => ['failedEips' => [[
            'eipId' => 'eip-b', 'errorCode' => 'INVALID_PARAMETER', 'errorMsg' => 'Cannot modify this EIP.',
        ]]]], 200)]);

        $response = ZenlayerCloud::zec()->ModifyEipsBlockThreshold(
            (new Models\ModifyEipsBlockThresholdRequest)->fromArray(['eipIds' => ['eip-a', 'eip-b'], 'enable' => false]),
        );

        self::assertCount(1, $response->response->failedEips);
        self::assertInstanceOf(Models\ModifyEipsBlockThresholdFailedItem::class, $response->response->failedEips[0]);
        self::assertSame('eip-b', $response->response->failedEips[0]->eipId);
        self::assertSame('INVALID_PARAMETER', $response->response->failedEips[0]->errorCode);
        Http::assertSentCount(1);
    }

    /** @param array<string,bool|string> $payload */
    #[DataProvider('newFilterProvider')]
    public function test_new_filters_are_sent_without_overriding_server_defaults(string $action, array $payload): void
    {
        Http::fake(['*' => Http::response(['response' => (object) []], 200)]);
        $class = 'ZenlayerCloud\\Laravel\\Zec\\V20250901\\Models\\'.$action.'Request';

        ZenlayerCloud::zec()->{$action}((new $class)->fromArray($payload));

        Http::assertSent(fn (Request $sent): bool => $sent->data() === $payload);
        self::assertSame('{}', (new $class)->toJson());
    }

    /** @return array<string,array{string,array<string,bool|string>}> */
    public static function newFilterProvider(): array
    {
        return [
            'customized EIPs false' => ['DescribeEips', ['isCustomized' => false]],
            'default security groups false' => ['DescribeSecurityGroups', ['isDefault' => false]],
            'purchased IPv6 CIDRs' => ['DescribeIpv6Cidrs', ['source' => 'CONSOLE']],
            'BYO IPv6 CIDRs' => ['DescribeIpv6Cidrs', ['source' => 'BYOIP']],
        ];
    }

    public function test_added_existing_model_fields_are_preserved(): void
    {
        Http::fakeSequence()
            ->push(['response' => ['dataSet' => [['isCustomized' => false]]]])
            ->push(['response' => ['dataSet' => [['cidrId' => 'cidr-test', 'subnetMaskLength' => 72]]]])
            ->push(['response' => ['regionSet' => [['regionId' => 'asia-east-1', 'location' => 'Shanghai', 'wideRegionName' => 'APAC', 'wideRegionTitle' => 'Asia Pacific']]]]);

        self::assertFalse(ZenlayerCloud::zec()->DescribeEips(new Models\DescribeEipsRequest)->response->dataSet[0]->isCustomized);
        self::assertSame(72, ZenlayerCloud::zec()->DescribeIpv6Cidrs(new Models\DescribeIpv6CidrsRequest)->response->dataSet[0]->subnetMaskLength);
        $region = ZenlayerCloud::zec()->DescribeRegions(new Models\DescribeRegionsRequest)->response->regionSet[0];
        self::assertSame('Shanghai', $region->location);
        self::assertSame('APAC', $region->wideRegionName);
        self::assertSame('Asia Pacific', $region->wideRegionTitle);
    }
}
