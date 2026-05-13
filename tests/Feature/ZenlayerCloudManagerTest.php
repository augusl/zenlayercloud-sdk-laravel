<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Tests\TestCase;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\ZenlayerCloudManager;

final class ZenlayerCloudManagerTest extends TestCase
{
    public function test_resolves_default_connection_without_argument(): void
    {
        $vm = ZenlayerCloud::vm();

        self::assertInstanceOf(VmClient::class, $vm);
    }

    public function test_caches_client_per_connection_name(): void
    {
        $vmA = ZenlayerCloud::vm();
        $vmB = ZenlayerCloud::vm();
        $vmStg = ZenlayerCloud::vm('staging');

        self::assertSame($vmA, $vmB, 'Same connection must reuse the same client instance.');
        self::assertNotSame($vmA, $vmStg, 'Different connections must yield different clients.');
    }

    public function test_unknown_connection_throws_config_invalid(): void
    {
        try {
            ZenlayerCloud::vm('nonexistent');
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CONFIG_INVALID, $e->errorCode);
            self::assertStringContainsString('[nonexistent]', $e->getMessage());
        }
    }

    public function test_flush_clients_drops_cache(): void
    {
        $manager = $this->app->make(ZenlayerCloudManager::class);

        $first = $manager->vm();
        $manager->flushClients();
        $second = $manager->vm();

        self::assertNotSame($first, $second);
    }

    public function test_missing_credential_throws_credential_missing(): void
    {
        $this->app['config']->set('zenlayercloud.connections.empty_cred', [
            'secret_key_id' => '',
            'secret_key_password' => '',
            'endpoint' => 'console.zenlayer.com',
        ]);

        try {
            ZenlayerCloud::vm('empty_cred');
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CREDENTIAL_MISSING, $e->errorCode);
        }
    }
}
