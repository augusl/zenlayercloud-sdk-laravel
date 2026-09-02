<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use SensitiveParameter;
use ZenlayerCloud\Laravel\Common\AbstractModel;
use ZenlayerCloud\Laravel\Ipt\V20240901\IptClient;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\StopInstancesRequest;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\Models;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\BandwidthPriceResponseItem;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\CreateEipsRequest;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\CrossRegionBandwidthMetricValue;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\DescribeCrossRegionBandwidthMonitorDataResponse;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\DescribeRegionsResponse;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\EipPreviousPrices;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\InquiryPriceModifyEipBandwidthResponse;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\RegionItem;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

final class GeneratedApiSurfaceTest extends TestCase
{
    /**
     * @param  class-string  $clientClass
     * @param  list<string>  $requiredActions
     */
    #[DataProvider('serviceProvider')]
    public function test_generated_client_action_contract(
        string $clientClass,
        int $expectedActionCount,
        array $requiredActions,
    ): void {
        $reflection = new ReflectionClass($clientClass);
        $methods = array_values(array_filter(
            $reflection->getMethods(ReflectionMethod::IS_PUBLIC),
            static fn (ReflectionMethod $method): bool => $method->getDeclaringClass()->getName() === $clientClass,
        ));

        self::assertCount($expectedActionCount, $methods);

        $actualActions = array_map(
            static fn (ReflectionMethod $method): string => $method->getName(),
            $methods,
        );
        foreach ($requiredActions as $action) {
            self::assertContains($action, $actualActions, "Missing generated Action [{$action}].");
        }

        foreach ($methods as $method) {
            self::assertCount(1, $method->getParameters(), "{$method->getName()} must accept one request model.");

            $requestParameter = $method->getParameters()[0];
            $requestType = $requestParameter->getType();
            $responseType = $method->getReturnType();
            self::assertInstanceOf(ReflectionNamedType::class, $requestType);
            self::assertInstanceOf(ReflectionNamedType::class, $responseType);
            self::assertTrue(is_subclass_of($requestType->getName(), AbstractModel::class));
            self::assertTrue(is_subclass_of($responseType->getName(), AbstractModel::class));
            self::assertCount(
                1,
                $requestParameter->getAttributes(SensitiveParameter::class),
                "{$method->getName()} request must be hidden from exception traces.",
            );
        }

        $probe = match ($clientClass) {
            VmClient::class => new VmClientRoutingProbe,
            IptClient::class => new IptClientRoutingProbe,
            ZecClient::class => new ZecClientRoutingProbe,
        };

        foreach ($methods as $method) {
            $requestType = $method->getParameters()[0]->getType();
            $responseType = $method->getReturnType();
            self::assertInstanceOf(ReflectionNamedType::class, $requestType);
            self::assertInstanceOf(ReflectionNamedType::class, $responseType);

            $requestClass = $requestType->getName();
            self::assertTrue(class_exists($requestClass));
            $request = new $requestClass;

            $response = $method->invoke($probe, $request);

            self::assertSame($method->getName(), $probe->lastAction);
            self::assertSame($request, $probe->lastRequest);
            self::assertSame($responseType->getName(), $probe->lastResponseClass);
            self::assertSame($responseType->getName(), $response::class);
        }
    }

    #[DataProvider('modelProvider')]
    public function test_every_generated_model_is_autoloadable(
        string $modelsDirectory,
        string $modelNamespace,
        int $expectedModelCount,
    ): void {
        $files = glob($modelsDirectory.'/*.php');
        self::assertIsArray($files);
        self::assertCount($expectedModelCount, $files);

        foreach ($files as $file) {
            $class = $modelNamespace.'\\'.pathinfo($file, PATHINFO_FILENAME);
            self::assertTrue(class_exists($class), "Generated model [{$class}] cannot be autoloaded.");
            self::assertTrue(is_subclass_of($class, AbstractModel::class));
        }
    }

    public function test_create_eips_instance_id_is_serialized(): void
    {
        $request = new CreateEipsRequest;
        $request->instanceId = 'instance-123';
        $request->instanceIds = ['instance-a', 'instance-b'];

        self::assertSame([
            'instanceId' => 'instance-123',
            'instanceIds' => ['instance-a', 'instance-b'],
        ], $request->toArray());
    }

    public function test_documented_vm_force_shutdown_default_is_preserved(): void
    {
        $doc = (new ReflectionClass(StopInstancesRequest::class))
            ->getProperty('forceShutdown')
            ->getDocComment();

        self::assertIsString($doc);
        self::assertStringContainsString('默认为 true', $doc);
    }

    public function test_latest_zec_regions_contract_hydrates_typed_region_items(): void
    {
        $response = (new DescribeRegionsResponse)->fromArray([
            'requestId' => 'outer-request',
            'response' => [
                'requestId' => 'inner-request',
                'regionSet' => [[
                    'regionId' => 'asia-east-1',
                    'regionName' => 'Singapore',
                    'administrativeRegion' => 'Singapore',
                ]],
            ],
        ]);

        self::assertNotNull($response->response);
        self::assertSame('inner-request', $response->response->requestId);
        self::assertIsArray($response->response->regionSet);
        self::assertCount(1, $response->response->regionSet);
        self::assertInstanceOf(RegionItem::class, $response->response->regionSet[0]);
        self::assertSame('asia-east-1', $response->response->regionSet[0]->regionId);
    }

    public function test_latest_zec_pricing_and_monitor_fields_are_preserved(): void
    {
        $pricing = (new InquiryPriceModifyEipBandwidthResponse)->fromArray([
            'response' => [
                'previousPrices' => [
                    'bandwidthPrices' => [[
                        'trafficType' => 'ALL',
                        'price' => ['unitPrice' => 1.25],
                    ]],
                ],
            ],
        ]);

        self::assertNotNull($pricing->response);
        self::assertInstanceOf(EipPreviousPrices::class, $pricing->response->previousPrices);
        self::assertIsArray($pricing->response->previousPrices->bandwidthPrices);
        self::assertCount(1, $pricing->response->previousPrices->bandwidthPrices);
        self::assertInstanceOf(
            BandwidthPriceResponseItem::class,
            $pricing->response->previousPrices->bandwidthPrices[0],
        );
        self::assertSame(1.25, $pricing->response->previousPrices->bandwidthPrices[0]->price?->unitPrice);

        $monitor = (new DescribeCrossRegionBandwidthMonitorDataResponse)->fromArray([
            'response' => [
                'loseInMaxValue' => 0.25,
                'loseOutTotalValue' => 0.5,
                'dataList' => [[
                    'time' => '2026-09-02T00:00:00Z',
                    'loseInValue' => 0.1,
                    'loseOutValue' => 0.2,
                ]],
            ],
        ]);

        self::assertNotNull($monitor->response);
        self::assertSame(0.25, $monitor->response->loseInMaxValue);
        self::assertSame(0.5, $monitor->response->loseOutTotalValue);
        self::assertIsArray($monitor->response->dataList);
        self::assertCount(1, $monitor->response->dataList);
        self::assertInstanceOf(CrossRegionBandwidthMetricValue::class, $monitor->response->dataList[0]);
        self::assertSame(0.1, $monitor->response->dataList[0]->loseInValue);
        self::assertSame(0.2, $monitor->response->dataList[0]->loseOutValue);
    }

    public function test_latest_zec_previous_price_fields_use_the_expected_models(): void
    {
        $expected = [
            Models\InquiryPriceModifyInstanceTypeResponseParams::class => Models\InstanceTypePreviousPrices::class,
            Models\InquiryPriceResizeDiskResponseParams::class => Models\ResizeDiskPreviousPrices::class,
            Models\InquiryPriceChangeIpv6InternetChargeTypeResponseParams::class => Models\Ipv6PreviousPrices::class,
            Models\InquiryPriceModifyIpv6BandwidthResponseParams::class => Models\Ipv6PreviousPrices::class,
            Models\InquiryPriceModifyEipBandwidthResponseParams::class => EipPreviousPrices::class,
            Models\InquiryPriceModifyEipFlowPackageResponseParams::class => EipPreviousPrices::class,
            Models\InquiryPriceChangeEipInternetChargeTypeResponseParams::class => EipPreviousPrices::class,
            Models\InquiryPriceModifyCrossRegionBandwidthResponseParams::class => Models\CrossRegionBandwidthPreviousPrices::class,
            Models\InquiryPriceModifyUnmanagedEgressIpBandwidthResponseParams::class => Models\UnmanagedEgressIpPreviousPrices::class,
            Models\InquiryPriceChangeUnmanagedEgressIpInternetChargeTypeResponseParams::class => Models\UnmanagedEgressIpPreviousPrices::class,
        ];

        foreach ($expected as $responseClass => $previousPricesClass) {
            $type = (new ReflectionClass($responseClass))
                ->getProperty('previousPrices')
                ->getType();

            self::assertInstanceOf(ReflectionNamedType::class, $type);
            self::assertSame($previousPricesClass, $type->getName());
        }
    }

    /** @return array<string,array{class-string,int,list<string>}> */
    public static function serviceProvider(): array
    {
        return [
            'VM 20260401' => [VmClient::class, 62, ['CreateInstances', 'DescribeZones']],
            'IPT 20240901' => [IptClient::class, 12, [
                'CreateIPTransit',
                'DeleteIPTransit',
                'DescribeIPTransitDatacenters',
                'DescribeIPTransits',
                'ModifyIPTransitConfig',
            ]],
            'ZEC 20250901' => [ZecClient::class, 226, [
                'CreateSubnets',
                'DeleteSubnets',
                'DescribeEipNetworkLineTypes',
                'DescribeInterconnectBorderGatewayRegions',
                'DescribeRegions',
                'DescribeZoneAcceleratorConfigInfos',
                'DescribeZoneGpuInstanceConfigInfos',
                'ModifyEipBlockThreshold',
                'ModifyEipTrafficPackage',
                'ModifyIpv6Bandwidth',
                'ModifyIpv6TrafficPackage',
                'ReplaceNetworkInterfacePrimaryIpv4',
            ]],
        ];
    }

    /** @return array<string,array{string,string,int}> */
    public static function modelProvider(): array
    {
        return [
            'VM models' => [
                dirname(__DIR__, 2).'/src/Vm/V20260401/Models',
                'ZenlayerCloud\\Laravel\\Vm\\V20260401\\Models',
                213,
            ],
            'IPT models' => [
                dirname(__DIR__, 2).'/src/Ipt/V20240901/Models',
                'ZenlayerCloud\\Laravel\\Ipt\\V20240901\\Models',
                59,
            ],
            'ZEC models' => [
                dirname(__DIR__, 2).'/src/Zec/V20250901/Models',
                'ZenlayerCloud\\Laravel\\Zec\\V20250901\\Models',
                771,
            ],
        ];
    }
}

trait RecordsActionRouting
{
    public ?string $lastAction = null;

    public ?AbstractModel $lastRequest = null;

    /** @var class-string<AbstractModel>|null */
    public ?string $lastResponseClass = null;

    public function __construct() {}

    /**
     * @template TResp of AbstractModel
     *
     * @param  class-string<TResp>  $responseClass
     * @return TResp
     */
    protected function call(
        string $action,
        #[SensitiveParameter] AbstractModel $request,
        string $responseClass,
    ): AbstractModel {
        $this->lastAction = $action;
        $this->lastRequest = $request;
        $this->lastResponseClass = $responseClass;

        return new $responseClass;
    }
}

final class VmClientRoutingProbe extends VmClient
{
    use RecordsActionRouting;
}

final class IptClientRoutingProbe extends IptClient
{
    use RecordsActionRouting;
}

final class ZecClientRoutingProbe extends ZecClient
{
    use RecordsActionRouting;
}
