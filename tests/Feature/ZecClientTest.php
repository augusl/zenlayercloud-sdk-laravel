<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
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
}
