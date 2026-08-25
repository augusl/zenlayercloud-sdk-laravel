<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel;

use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\ServiceProvider;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

/**
 * Not deferred on purpose: a deferred provider's boot() only runs once one of
 * its provided classes is resolved, which never happens during
 * `php artisan vendor:publish` — so deferring would silently break publishing
 * the config file (the documented install step). The boot cost here is
 * negligible: register() only merges the config array and registers lazy
 * singletons.
 */
class ZenlayerCloudServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zenlayercloud.php', 'zenlayercloud');

        $this->app->singleton(Signer::class, static fn () => new Signer);

        $this->app->singleton(
            HttpClientFactory::class,
            static fn (Container $app): HttpClientFactory => new HttpClientFactory(
                $app->make(HttpFactory::class),
                $app->make('log'),
            ),
        );

        $this->app->singleton(
            ZenlayerCloudManager::class,
            static fn (Container $app): ZenlayerCloudManager => new ZenlayerCloudManager(
                $app->make('config'),
                $app->make(HttpClientFactory::class),
                $app->make(Signer::class),
            ),
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
}
