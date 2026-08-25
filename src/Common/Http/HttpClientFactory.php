<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common\Http;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ZenlayerCloud\Laravel\Common\Config;

/**
 * Translates a {@see Config} object into an {@see PendingRequest} built from
 * Laravel's HTTP client (which is the seam used by
 * `\Illuminate\Support\Facades\Http::fake()` in test code).
 */
final class HttpClientFactory
{
    private readonly LoggerInterface $logger;

    public function __construct(
        private readonly Factory $factory,
        ?LoggerInterface $logger = null,
    ) {
        $this->logger = $logger ?? new NullLogger;
    }

    /**
     * Apply the SDK-level Config (timeout, proxy, TLS, debug) to a fresh
     * {@see PendingRequest}. Each call returns a new request — chain
     * {@see PendingRequest::withHeaders()} and {@see PendingRequest::post()}
     * to send.
     */
    public function build(Config $config): PendingRequest
    {
        $request = $this->factory->timeout($config->timeout);

        $options = [];
        if ($config->proxy !== null && $config->proxy !== '') {
            $options['proxy'] = $config->proxy;
        }
        if ($config->verify !== true) {
            // Custom CA bundle path, or `false` to disable verification for
            // self-signed staging endpoints. Defaults to full verification.
            $options['verify'] = $config->verify;
        }
        if ($options !== []) {
            $request = $request->withOptions($options);
        }

        if ($config->debug) {
            // Guzzle's wire-level `debug` option prints Authorization and the
            // complete JSON body. Log only non-sensitive request metadata and
            // response status instead.
            $request = $request
                ->beforeSending(function (Request $request): void {
                    $this->logger->debug('Zenlayer Cloud API request', [
                        'method' => $request->method(),
                        'url' => $request->url(),
                        'service' => $request->header('x-zc-service')[0] ?? null,
                        'action' => $request->header('x-zc-action')[0] ?? null,
                    ]);
                });
        }

        return $request;
    }

    public function logResponse(Config $config, int $status, string $service, string $action): void
    {
        if (! $config->debug) {
            return;
        }

        $this->logger->debug('Zenlayer Cloud API response', [
            'status' => $status,
            'service' => $service,
            'action' => $action,
        ]);
    }
}
