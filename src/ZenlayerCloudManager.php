<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\CredentialInterface;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Common\TokenCredential;
use ZenlayerCloud\Laravel\Ipt\V20240901\IptClient;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

/**
 * Entry-point Manager for the Zenlayer Cloud SDK in a Laravel application.
 *
 * Resolves named "connections" defined in config/zenlayercloud.php and lazily
 * builds typed service clients (VmClient, IptClient, ZecClient).
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

    /** @var array<string,IptClient> */
    private array $iptClients = [];

    /** @var array<string,ZecClient> */
    private array $zecClients = [];

    public function __construct(
        protected readonly ConfigRepository $config,
        protected readonly HttpClientFactory $http,
        protected readonly Signer $signer,
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

        if (isset($this->vmClients[$name])) {
            return $this->vmClients[$name];
        }

        $connectionConfig = $this->connectionConfig($name);

        return $this->vmClients[$name] = new VmClient(
            $this->credential($connectionConfig),
            $this->configFor($connectionConfig),
            $this->http,
            $this->signer,
        );
    }

    /**
     * Resolve the IPT service client for the given connection (or the
     * default connection if `$connection` is null). Same caching contract
     * as {@see self::vm()}.
     */
    public function ipt(?string $connection = null): IptClient
    {
        $name = $connection ?? $this->defaultConnection();

        if (isset($this->iptClients[$name])) {
            return $this->iptClients[$name];
        }

        $connectionConfig = $this->connectionConfig($name);

        return $this->iptClients[$name] = new IptClient(
            $this->credential($connectionConfig),
            $this->configFor($connectionConfig),
            $this->http,
            $this->signer,
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

        if (isset($this->zecClients[$name])) {
            return $this->zecClients[$name];
        }

        $connectionConfig = $this->connectionConfig($name);

        return $this->zecClients[$name] = new ZecClient(
            $this->credential($connectionConfig),
            $this->configFor($connectionConfig),
            $this->http,
            $this->signer,
        );
    }

    /**
     * Drop the cached client instances. Useful from tests that mutate the
     * Laravel config at runtime — call this before re-resolving clients.
     */
    public function flushClients(): void
    {
        $this->vmClients = [];
        $this->iptClients = [];
        $this->zecClients = [];
    }

    private function defaultConnection(): string
    {
        $name = $this->config->get('zenlayercloud.default', 'default');
        if (! is_string($name) || trim($name) === '') {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
                'zenlayercloud.default must be a non-empty connection name.',
            );
        }

        return $name;
    }

    /**
     * @return array<string,mixed>
     */
    private function connectionConfig(string $name): array
    {
        $connections = $this->config->get('zenlayercloud.connections', []);
        $conn = is_array($connections) ? ($connections[$name] ?? null) : null;
        if (! is_array($conn)) {
            throw new ZenlayerCloudSdkException(
                ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
                "Zenlayer Cloud connection [{$name}] is not configured. ".
                "Check the 'connections' array in config/zenlayercloud.php.",
            );
        }

        $types = [
            'secret_key_id' => 'nullable-string',
            'secret_key_password' => 'nullable-string',
            'token' => 'nullable-string',
            'endpoint' => 'string',
            'scheme' => 'string',
            'timeout' => 'int',
            'retry' => 'bool',
            'retry_max' => 'int',
            'debug' => 'bool',
            'proxy' => 'nullable-string',
            'verify' => 'bool-or-string',
            'request_client' => 'nullable-string',
            'rate_limit_max_retries' => 'int',
            'rate_limit_retry_delay_ms' => 'int',
        ];

        foreach ($types as $key => $expected) {
            if (! array_key_exists($key, $conn)) {
                continue;
            }

            $value = $conn[$key];
            $valid = match ($expected) {
                'string' => is_string($value),
                'nullable-string' => $value === null || is_string($value),
                'int' => is_int($value),
                'bool' => is_bool($value),
                'bool-or-string' => is_bool($value) || is_string($value),
            };

            if (! $valid) {
                $expectedLabel = match ($expected) {
                    'nullable-string' => 'a string or null',
                    'bool-or-string' => 'a boolean or string',
                    default => "a {$expected}",
                };

                throw new ZenlayerCloudSdkException(
                    ZenlayerCloudSdkException::ERR_CONFIG_INVALID,
                    "Zenlayer Cloud connection [{$name}] option [{$key}] must be {$expectedLabel}.",
                );
            }
        }

        return $conn;
    }

    /** @param array<string,mixed> $connection */
    private function credential(array $connection): CredentialInterface
    {
        // A configured Bearer token takes precedence over the AccessKey pair,
        // matching the upstream SDKs (a connection is either token- or
        // key-authenticated, never both).
        $token = $connection['token'] ?? null;
        if (is_string($token) && trim($token) !== '') {
            return new TokenCredential($token);
        }

        return new Credential(
            $connection['secret_key_id'] ?? '',
            $connection['secret_key_password'] ?? '',
        );
    }

    /** @param array<string,mixed> $connection */
    private function configFor(array $connection): Config
    {
        $verify = $connection['verify'] ?? true;

        return new Config(
            endpoint: $connection['endpoint'] ?? 'console.zenlayer.com',
            scheme: $connection['scheme'] ?? 'https',
            timeout: $connection['timeout'] ?? 60,
            retry: $connection['retry'] ?? false,
            retryMax: $connection['retry_max'] ?? 3,
            debug: $connection['debug'] ?? false,
            proxy: $connection['proxy'] ?? null,
            verify: $verify,
            requestClient: $connection['request_client'] ?? null,
            rateLimitMaxRetries: $connection['rate_limit_max_retries'] ?? 3,
            rateLimitRetryDelayMs: $connection['rate_limit_retry_delay_ms'] ?? 1000,
        );
    }
}
