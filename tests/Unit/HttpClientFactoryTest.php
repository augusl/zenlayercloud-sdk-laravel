<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use Illuminate\Http\Client\Factory;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Stringable;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;

final class HttpClientFactoryTest extends TestCase
{
    public function test_debug_logging_never_contains_credentials_or_bodies(): void
    {
        $factory = new Factory;
        $factory->fake([
            '*' => $factory->response(['response' => ['secret' => 'response-secret']], 200),
        ]);

        $logger = new class extends AbstractLogger
        {
            /** @var list<array{level:mixed,message:string,context:array<string,mixed>}> */
            public array $records = [];

            /**
             * @param  mixed  $level
             * @param  string|Stringable  $message
             * @param  array<string,mixed>  $context
             */
            public function log($level, $message, array $context = []): void
            {
                $this->records[] = [
                    'level' => $level,
                    'message' => (string) $message,
                    'context' => $context,
                ];
            }
        };

        $client = new HttpClientFactory($factory, $logger);
        $config = new Config(debug: true);
        $response = $client->build($config)
            ->withHeaders([
                'Authorization' => 'Bearer top-secret-token',
                'x-zc-service' => 'vm',
                'x-zc-action' => 'CreateInstances',
            ])
            ->withBody('{"password":"request-secret"}', 'application/json')
            ->post('https://console.zenlayer.com/api/v2/vm');
        $client->logResponse($config, $response->status(), 'vm', 'CreateInstances');

        self::assertCount(2, $logger->records);
        $serialized = json_encode($logger->records, JSON_THROW_ON_ERROR);
        self::assertStringNotContainsString('top-secret-token', $serialized);
        self::assertStringNotContainsString('request-secret', $serialized);
        self::assertStringNotContainsString('response-secret', $serialized);
        self::assertStringContainsString('CreateInstances', $serialized);
    }
}
