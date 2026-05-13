<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\ServiceProvider;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

/**
 * Deferred — Laravel only loads this provider when one of the classes listed
 * in {@see self::provides()} is resolved (or when `vendor:publish` runs).
 * Apps that never touch the SDK pay zero boot cost.
 */
class ZenlayerCloudServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zenlayercloud.php', 'zenlayercloud');

        $this->app->singleton(Signer::class, static fn () => new Signer);

        $this->app->singleton(
            HttpClientFactory::class,
            static fn (Container $app): HttpClientFactory => new HttpClientFactory($app->make(HttpFactory::class)),
        );

        $this->app->singleton(
            ZenlayerCloudManager::class,
            static fn (Container $app): ZenlayerCloudManager => new ZenlayerCloudManager($app, $app->make('config')),
        );

        // Convenience auto-wiring: type-hint VmClient / ZecClient anywhere and
        // get a client for the 'default' connection without going through the
        // manager.
        $this->app->bind(
            VmClient::class,
            static fn (Container $app): VmClient => $app->make(ZenlayerCloudManager::class)->vm(),
        );
        $this->app->bind(
            ZecClient::class,
            static fn (Container $app): ZecClient => $app->make(ZenlayerCloudManager::class)->zec(),
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/zenlayercloud.php' => $this->app->configPath('zenlayercloud.php'),
            ], 'zenlayercloud-config');
        }
    }

    /**
     * @return array<int,string>
     */
    public function provides(): array
    {
        return [
            Signer::class,
            HttpClientFactory::class,
            ZenlayerCloudManager::class,
            VmClient::class,
            ZecClient::class,
        ];
    }
}
