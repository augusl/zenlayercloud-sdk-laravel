<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\ZenlayerCloudServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [ZenlayerCloudServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return ['ZenlayerCloud' => ZenlayerCloud::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('zenlayercloud', [
            'default' => 'default',
            'connections' => [
                'default' => [
                    'secret_key_id' => 'AKID-default-test',
                    'secret_key_password' => 'SK-default-secret',
                    'endpoint' => 'console.zenlayer.com',
                    'scheme' => 'https',
                    'timeout' => 60,
                    'retry' => false,
                    'retry_max' => 3,
                    'debug' => false,
                    'proxy' => null,
                    'request_client' => null,
                ],
                'staging' => [
                    'secret_key_id' => 'AKID-staging-test',
                    'secret_key_password' => 'SK-staging-secret',
                    'endpoint' => 'staging.zenlayer.local',
                    'scheme' => 'https',
                    'timeout' => 30,
                    'retry' => true,
                    'retry_max' => 5,
                    'debug' => true,
                    'proxy' => null,
                    'request_client' => 'tests-suite-1.0',
                ],
                'token' => [
                    'token' => 'PAT-token-test-xyz',
                    'endpoint' => 'console.zenlayer.com',
                    'scheme' => 'https',
                ],
            ],
        ]);
    }
}
