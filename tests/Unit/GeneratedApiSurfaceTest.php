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
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\CreateEipsRequest;
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

    public function test_documented_create_eips_instance_id_override_is_serialized(): void
    {
        $request = new CreateEipsRequest;
        $request->instanceId = 'instance-123';
        $request->instanceIds = ['instance-a', 'instance-b'];

        self::assertSame([
            'instanceId' => 'instance-123',
            'instanceIds' => ['instance-a', 'instance-b'],
        ], $request->toArray());
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
            'ZEC 20250901' => [ZecClient::class, 225, [
                'CreateSubnets',
                'DeleteSubnets',
                'DescribeEipNetworkLineTypes',
                'DescribeInterconnectBorderGatewayRegions',
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
                761,
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
