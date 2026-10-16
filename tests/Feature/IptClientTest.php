<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Ipt\V20240901\IptClient;
use ZenlayerCloud\Laravel\Ipt\V20240901\Models;
use ZenlayerCloud\Laravel\Tests\TestCase;

final class IptClientTest extends TestCase
{
    public function test_describe_datacenters_via_ipt_client(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-ipt-1',
                'response' => [
                    'requestId' => 'req-ipt-1',
                    'supportSet' => [[
                        'dataCenter' => ['dcId' => 'FRA-A', 'dcName' => 'Frankfurt'],
                        'availableRoutingTypes' => [[
                            'routingType' => 'BGP',
                            'availableBgpTiers' => ['STANDARD', 'PREMIUM'],
                            'peerAsns' => [['tier' => 'STANDARD', 'asn' => 4294967295]],
                            'publicInterconnectNetmasks' => [30, 31],
                        ]],
                    ]],
                ],
            ], 200),
        ]);

        $response = ZenlayerCloud::ipt()->DescribeIPTransitDatacenters(
            new Models\DescribeIPTransitDatacentersRequest,
        );

        self::assertSame('req-ipt-1', $response->requestId);
        self::assertSame('FRA-A', $response->response->supportSet[0]->dataCenter->dcId);
        self::assertSame('BGP', $response->response->supportSet[0]->availableRoutingTypes[0]->routingType);
        $routing = $response->response->supportSet[0]->availableRoutingTypes[0];
        self::assertInstanceOf(Models\IPTransitAvailableRoutingType::class, $routing);
        self::assertSame(['STANDARD', 'PREMIUM'], $routing->availableBgpTiers);
        self::assertInstanceOf(Models\RiptPeerAsn::class, $routing->peerAsns[0]);
        self::assertSame('STANDARD', $routing->peerAsns[0]->tier);
        self::assertSame(4294967295, $routing->peerAsns[0]->asn);
        self::assertSame([30, 31], $response->response->supportSet[0]->availableRoutingTypes[0]->publicInterconnectNetmasks);

        Http::assertSent(function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://console.zenlayer.com/api/v2/ipt'
                && $request->header('x-zc-action')[0] === 'DescribeIPTransitDatacenters'
                && $request->header('x-zc-service')[0] === 'ipt'
                && $request->header('x-zc-version')[0] === '2024-09-01';
        });
    }

    public function test_ipt_client_via_type_hint(): void
    {
        Http::fake([
            'console.zenlayer.com/*' => Http::response([
                'requestId' => 'req-ipt-2',
                'response' => ['requestId' => 'req-ipt-2', 'dataSet' => []],
            ], 200),
        ]);

        $ipt = $this->app->make(IptClient::class);
        self::assertInstanceOf(IptClient::class, $ipt);

        $ipt->DescribeIPTransitAvailableAsns(new Models\DescribeIPTransitAvailableAsnsRequest);
        Http::assertSentCount(1);
    }

    #[DataProvider('bgpTierProvider')]
    public function test_bgp_tiers_are_sent_in_pricing_and_nested_creation_config(?string $tier): void
    {
        Http::fake(['*' => Http::response(['response' => ['requestId' => 'ipt-tier']], 200)]);

        $pricing = (new Models\InquiryCreateIPTransitPriceRequest)->fromArray([
            'peerPortId' => 'port-test',
            'routingType' => 'BGP',
            'bgpTier' => $tier,
        ]);
        $creation = (new Models\CreateIPTransitRequest)->fromArray([
            'peerPortId' => 'port-test',
            'routingType' => 'BGP',
            'bgp' => ['asn' => 4294967295, 'tier' => $tier],
        ]);

        ZenlayerCloud::ipt()->InquiryCreateIPTransitPrice($pricing);
        ZenlayerCloud::ipt()->CreateIPTransit($creation);

        $expectedPricing = ['peerPortId' => 'port-test', 'routingType' => 'BGP'];
        $expectedBgp = ['asn' => 4294967295];
        if ($tier !== null) {
            $expectedPricing['bgpTier'] = $tier;
            $expectedBgp['tier'] = $tier;
        }

        self::assertInstanceOf(Models\RiptBgpConfig::class, $creation->bgp);
        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'InquiryCreateIPTransitPrice'
            && $request->data() == $expectedPricing);
        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'CreateIPTransit'
            && $request->data() == [
                'peerPortId' => 'port-test',
                'routingType' => 'BGP',
                'bgp' => $expectedBgp,
            ]);
        Http::assertSentCount(2);
    }

    /** @return array<string,array{?string}> */
    public static function bgpTierProvider(): array
    {
        return ['server default' => [null], 'standard' => ['STANDARD'], 'premium' => ['PREMIUM']];
    }

    #[DataProvider('trafficSamplingProvider')]
    public function test_traffic_sampling_parameters_preserve_server_defaults(?int $period, ?string $statistic): void
    {
        Http::fake(['*' => Http::response(['response' => ['requestId' => 'traffic-test']], 200)]);

        ZenlayerCloud::ipt()->DescribeIPTransitTraffic(
            (new Models\DescribeIPTransitTrafficRequest)->fromArray([
                'iptId' => 'ipt-test', 'period' => $period, 'statistic' => $statistic,
            ]),
        );

        $expected = ['iptId' => 'ipt-test'];
        if ($period !== null) {
            $expected['period'] = $period;
        }
        if ($statistic !== null) {
            $expected['statistic'] = $statistic;
        }
        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === 'DescribeIPTransitTraffic'
            && $request->data() === $expected);
        Http::assertSentCount(1);
    }

    /** @return array<string,array{?int,?string}> */
    public static function trafficSamplingProvider(): array
    {
        return ['server defaults' => [null, null], 'average' => [300, 'Average'], 'maximum' => [20, 'Maximum']];
    }

    #[DataProvider('marketingInfoProvider')]
    public function test_marketing_info_is_identical_in_pricing_and_modification(?bool $usePocVoucher): void
    {
        Http::fake(['*' => Http::response(['response' => ['requestId' => 'marketing-test']], 200)]);
        $marketing = $usePocVoucher === null ? null : ['discountCode' => 'review-discount', 'usePocVoucher' => $usePocVoucher];
        $payload = ['iptId' => 'ipt-test', 'type' => 'ADD_CIDR_BLOCK', 'marketingInfo' => $marketing];
        $pricing = (new Models\InquiryModifyIPTransitPriceRequest)->fromArray($payload);
        $modification = (new Models\ModifyIPTransitConfigRequest)->fromArray($payload);

        ZenlayerCloud::ipt()->InquiryModifyIPTransitPrice($pricing);
        ZenlayerCloud::ipt()->ModifyIPTransitConfig($modification);

        if ($marketing === null) {
            unset($payload['marketingInfo']);
            self::assertNull($pricing->marketingInfo);
        } else {
            self::assertInstanceOf(Models\MarketingInfo::class, $pricing->marketingInfo);
            self::assertSame($usePocVoucher, $modification->marketingInfo->usePocVoucher);
        }
        foreach (['InquiryModifyIPTransitPrice', 'ModifyIPTransitConfig'] as $action) {
            Http::assertSent(fn (Request $request): bool => $request->header('x-zc-action')[0] === $action
                && $request->data() === $payload);
        }
        Http::assertSentCount(2);
    }

    /** @return array<string,array{?bool}> */
    public static function marketingInfoProvider(): array
    {
        return ['omitted' => [null], 'explicit false' => [false], 'voucher requested' => [true]];
    }
}
