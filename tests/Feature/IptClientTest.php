<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
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
}
