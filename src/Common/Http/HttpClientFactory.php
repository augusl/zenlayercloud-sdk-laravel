<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Common\Http;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use ZenlayerCloud\Laravel\Common\Config;

/**
 * Translates a {@see Config} object into an {@see PendingRequest} built from
 * Laravel's HTTP client (which is the seam used by
 * `\Illuminate\Support\Facades\Http::fake()` in test code).
 */
final class HttpClientFactory
{
    public function __construct(private readonly Factory $factory) {}

    /**
     * Apply the SDK-level Config (timeout, retry, proxy, debug) to a fresh
     * {@see PendingRequest}. Each call returns a new request — chain
     * {@see PendingRequest::withHeaders()} and {@see PendingRequest::post()}
     * to send.
     */
    public function build(Config $config): PendingRequest
    {
        $request = $this->factory->timeout($config->timeout);

        if ($config->retry) {
            $request = $request->retry(
                times: $config->retryMax,
                sleepMilliseconds: 200,
                when: static fn ($exception): bool => $exception instanceof ConnectionException,
                throw: false,
            );
        }

        $options = [];
        if ($config->proxy !== null && $config->proxy !== '') {
            $options['proxy'] = $config->proxy;
        }
        if ($config->debug) {
            $options['debug'] = true;
        }
        if ($options !== []) {
            $request = $request->withOptions($options);
        }

        return $request;
    }
}
