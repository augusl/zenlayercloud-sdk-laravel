<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Support\ServiceProvider;
use ZenlayerCloud\Laravel\Tests\TestCase;
use ZenlayerCloud\Laravel\ZenlayerCloudServiceProvider;

final class ServiceProviderPublishTest extends TestCase
{
    public function test_config_publish_group_is_registered(): void
    {
        // The documented install step is
        //   php artisan vendor:publish --tag=zenlayercloud-config
        // For that to work, the provider must have registered its publish
        // paths during boot. A deferred provider that never boots would make
        // this group empty and silently break installation.
        $paths = ServiceProvider::pathsToPublish(
            ZenlayerCloudServiceProvider::class,
            'zenlayercloud-config',
        );

        self::assertNotEmpty(
            $paths,
            'The zenlayercloud-config publish group must be registered so '
            .'`vendor:publish --tag=zenlayercloud-config` works.',
        );

        $target = array_values($paths)[0];
        self::assertStringEndsWith('zenlayercloud.php', $target);
    }
}
