<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Ipt\V20240901\IptClient;
use ZenlayerCloud\Laravel\Tests\TestCase;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\ZenlayerCloudManager;

final class ZenlayerCloudManagerTest extends TestCase
{
    public function test_resolves_default_connection_without_argument(): void
    {
        self::assertInstanceOf(VmClient::class, ZenlayerCloud::vm());
        self::assertInstanceOf(IptClient::class, ZenlayerCloud::ipt());
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

        $firstVm = $manager->vm();
        $firstIpt = $manager->ipt();
        $manager->flushClients();
        $secondVm = $manager->vm();
        $secondIpt = $manager->ipt();

        self::assertNotSame($firstVm, $secondVm);
        self::assertNotSame($firstIpt, $secondIpt);
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

    public function test_connection_names_containing_dots_are_resolved_exactly(): void
    {
        $connections = $this->app['config']->get('zenlayercloud.connections');
        $connections['customer.eu'] = [
            'token' => 'dot-name-token',
            'endpoint' => 'console.zenlayer.com',
        ];
        $this->app['config']->set('zenlayercloud.connections', $connections);

        self::assertInstanceOf(VmClient::class, ZenlayerCloud::vm('customer.eu'));
    }

    public function test_invalid_default_connection_type_fails_cleanly(): void
    {
        $this->app['config']->set('zenlayercloud.default', ['default']);

        try {
            ZenlayerCloud::vm();
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CONFIG_INVALID, $e->errorCode);
            self::assertStringContainsString('zenlayercloud.default', $e->getMessage());
        }
    }

    public function test_invalid_connection_option_type_fails_cleanly(): void
    {
        $connections = $this->app['config']->get('zenlayercloud.connections');
        $connections['invalid'] = [
            'token' => 'valid-token',
            'timeout' => ['sixty'],
        ];
        $this->app['config']->set('zenlayercloud.connections', $connections);

        try {
            ZenlayerCloud::vm('invalid');
            self::fail('Expected exception was not thrown.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CONFIG_INVALID, $e->errorCode);
            self::assertStringContainsString('[timeout]', $e->getMessage());
        }
    }
}
