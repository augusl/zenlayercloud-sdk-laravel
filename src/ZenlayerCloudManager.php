<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Container\Container;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

/**
 * Entry-point Manager for the Zenlayer Cloud SDK in a Laravel application.
 *
 * Resolves named "connections" defined in config/zenlayercloud.php and lazily
 * builds typed service clients (VmClient, ZecClient).
 *
 * Multi-account support is built-in:
 *
 *     ZenlayerCloud::vm()           // 'default' connection
 *     ZenlayerCloud::vm('staging')  // any named connection
 */
class ZenlayerCloudManager
{
    /** @var array<string,VmClient> */
    private array $vmClients = [];

    /** @var array<string,ZecClient> */
    private array $zecClients = [];

    public function __construct(
        protected readonly Container $container,
        protected readonly ConfigRepository $config,
    ) {}

    /**
     * Resolve the VM service client for the given connection (or the
     * default connection if `$connection` is null). Clients are cached
     * per connection name; the first call builds the client and the
     * subsequent calls return the same instance.
     */
    public function vm(?string $connection = null): VmClient
    {
        $name = $connection ?? $this->defaultConnection();

        return $this->vmClients[$name] ??= new VmClient(
            $this->credential($name),
            $this->configFor($name),
            $this->container->make(HttpClientFactory::class),
            $this->container->make(Signer::class),
        );
    }

    /**
     * Resolve the ZEC service client for the given connection (or the
     * default connection if `$connection` is null). Same caching contract
     * as {@see self::vm()}.
     */
    public function zec(?string $connection = null): ZecClient
    {
        $name = $connection ?? $this->defaultConnection();

        return $this->zecClients[$name] ??= new ZecClient(
            $this->credential($name),
            $this->configFor($name),
            $this->container->make(HttpClientFactory::class),
            $this->container->make(Signer::class),
        );
    }

    /**
     * Drop the cached client instances. Useful from tests that mutate the
     * Laravel config at runtime — call this before re-resolving clients.
     */
    public function flushClients(): void
    {
        $this->vmClients = [];
        $this->zecClients = [];
    }

    private function defaultConnection(): string
    {
        return (string) $this->config->get('zenlayercloud.default', 'default');
    }

    /**
     * @return array<string,mixed>
     */
    private function connectionConfig(string $name): array
    {
        $conn = $this->config->get("zenlayercloud.connections.{$name}");
        if (! is_array($conn)) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
                "Zenlayer Cloud connection [{$name}] is not configured. ".
                "Check the 'connections' array in config/zenlayercloud.php.",
            );
        }

        return $conn;
    }

    private function credential(string $name): Credential
    {
        $c = $this->connectionConfig($name);

        return new Credential(
            (string) ($c['secret_key_id'] ?? ''),
            (string) ($c['secret_key_password'] ?? ''),
        );
    }

    private function configFor(string $name): Config
    {
        $c = $this->connectionConfig($name);

        return new Config(
            endpoint: (string) ($c['endpoint'] ?? 'console.zenlayer.com'),
            scheme: (string) ($c['scheme'] ?? 'https'),
            timeout: (int) ($c['timeout'] ?? 60),
            retry: (bool) ($c['retry'] ?? false),
            retryMax: (int) ($c['retry_max'] ?? 3),
            debug: (bool) ($c['debug'] ?? false),
            proxy: isset($c['proxy']) ? (string) $c['proxy'] : null,
            requestClient: isset($c['request_client']) ? (string) $c['request_client'] : null,
        );
    }
}
