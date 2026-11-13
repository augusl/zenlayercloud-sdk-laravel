<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Feature;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use ZenlayerCloud\Laravel\Common\AbstractModel;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\SecurityTokenCredentialInterface;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Common\StsCredential;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Ipt\V20240901\Models as Ipt;
use ZenlayerCloud\Laravel\Tests\TestCase;
use ZenlayerCloud\Laravel\Vm\V20260401\Models as Vm;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\Models as Zec;

final class StsClientTest extends TestCase
{
    public function test_configured_sts_credentials_sign_all_three_services(): void
    {
        $this->app['config']->set('zenlayercloud.connections.default.security_token', 'zst_AbC-def_123');
        Http::fake(['*' => Http::response(['response' => ['requestId' => 'sts-test']], 200)]);

        ZenlayerCloud::vm()->DescribeZones(new Vm\DescribeZonesRequest);
        ZenlayerCloud::ipt()->DescribeIPTransitDatacenters(new Ipt\DescribeIPTransitDatacentersRequest);
        ZenlayerCloud::zec()->DescribeNetworkInterfacePermissions(new Zec\DescribeNetworkInterfacePermissionsRequest);

        Http::assertSentCount(3);
        foreach (['vm', 'ipt', 'zec'] as $service) {
            Http::assertSent(fn (Request $request): bool => $request->header('x-zc-service') === [$service]
                && $request->header('x-zc-security-token') === ['zst_AbC-def_123']
                && str_contains($request->header('Authorization')[0], 'SignedHeaders=content-type;host;x-zc-security-token,'));
        }
    }

    public function test_bearer_token_takes_precedence_over_sts_credentials(): void
    {
        $this->app['config']->set('zenlayercloud.connections.default.security_token', 'unused-sts-token');
        $this->app['config']->set('zenlayercloud.connections.default.token', 'bearer-token');
        Http::fake(['*' => Http::response(['response' => (object) []], 200)]);

        ZenlayerCloud::vm()->DescribeZones(new Vm\DescribeZonesRequest);

        Http::assertSent(fn (Request $request): bool => $request->header('Authorization') === ['Bearer bearer-token']
            && $request->header('x-zc-security-token') === []
            && $request->header('x-zc-timestamp') === []);
    }

    public function test_plain_keys_do_not_send_the_security_token_header(): void
    {
        Http::fake(['*' => Http::response(['response' => (object) []], 200)]);

        ZenlayerCloud::vm()->DescribeZones(new Vm\DescribeZonesRequest);

        Http::assertSent(fn (Request $request): bool => $request->header('x-zc-security-token') === []
            && str_contains($request->header('Authorization')[0], 'SignedHeaders=content-type;host,'));
    }

    #[DataProvider('invalidHeaderProvider')]
    public function test_invalid_security_token_headers_fail_without_exposing_values(string $control): void
    {
        Http::fake();
        $client = new VmClient(
            new StsCredential('STS.key', 'private-sts-password', 'private-prefix'.$control.'private-suffix'),
            new Config,
            $this->app->make(HttpClientFactory::class),
            new Signer,
        );

        try {
            $client->DescribeZones(new Vm\DescribeZonesRequest);
            self::fail('Expected invalid header error.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_CONFIG_INVALID, $e->errorCode);
            self::assertStringNotContainsString('private-prefix', $e->getMessage());
            self::assertStringNotContainsString('private-suffix', $e->getMessage());
            self::assertStringNotContainsString('private-sts-password', $e->getMessage());
            self::assertNull($e->getPrevious());
        }
        Http::assertNothingSent();
    }

    /** @return array<string,array{string}> */
    public static function invalidHeaderProvider(): array
    {
        return ['newline' => ["\n"], 'carriage return' => ["\r"], 'nul' => ["\0"], 'delete' => ["\x7F"]];
    }

    public function test_retry_reads_a_fresh_security_token_for_each_attempt(): void
    {
        $credential = new class implements SecurityTokenCredentialInterface
        {
            public int $reads = 0;

            public function getSecretKeyId(): string
            {
                return 'STS.key';
            }

            public function getSecretKeyPassword(): string
            {
                return 'temporary-password';
            }

            public function getToken(): ?string
            {
                return null;
            }

            public function getSecurityToken(): string
            {
                return 'zst_Rotating_'.++$this->reads;
            }
        };
        Http::fakeSequence()->push(['code' => 'REQUEST_LIMIT_EXCEEDED'], 429)
            ->push(['response' => (object) []], 200);
        $client = new VmClient($credential, new Config(rateLimitRetryDelayMs: 0), $this->app->make(HttpClientFactory::class), new Signer);

        $client->DescribeZones(new Vm\DescribeZonesRequest);

        self::assertSame(2, $credential->reads);
        Http::assertSentCount(2);
        foreach (['zst_Rotating_1', 'zst_Rotating_2'] as $token) {
            Http::assertSent(fn (Request $request): bool => $request->header('x-zc-security-token') === [$token]);
        }
    }

    public function test_transport_error_redacts_sts_secrets_from_messages_and_traces(): void
    {
        $ignoreArgs = ini_set('zend.exception_ignore_args', '0');
        Http::fake(static function () {
            throw new ConnectionException('Failed with private-sts-token and private-sts-password', 7);
        });
        $client = new VmClient(
            new StsCredential('STS.key', 'private-sts-password', 'private-sts-token'),
            new Config,
            $this->app->make(HttpClientFactory::class),
            new Signer,
        );

        try {
            $client->DescribeZones(new Vm\DescribeZonesRequest);
            self::fail('Expected transport error.');
        } catch (ZenlayerCloudSdkException $e) {
            self::assertSame(ZenlayerCloudSdkException::ERR_NETWORK, $e->errorCode);
            self::assertInstanceOf(ConnectionException::class, $e->getPrevious());
            self::assertSame(7, $e->getPrevious()->getCode());
            foreach ([$e, $e->getPrevious()] as $exception) {
                $diagnostic = $exception->getMessage().$exception->getTraceAsString();
                $values = [];
                foreach ($exception->getTrace() as $frame) {
                    if (($frame['class'] ?? null) === self::class && $frame['function'] === __FUNCTION__) {
                        break;
                    }
                    $values[] = $frame;
                }
                // Inspect SDK arguments, not caller-owned framework object
                // graphs (which may contain the application's entire state).
                while ($values !== []) {
                    $value = array_pop($values);
                    if (is_string($value)) {
                        $diagnostic .= $value;
                    } elseif ($value instanceof AbstractModel || $value instanceof \stdClass) {
                        array_push($values, ...array_values(get_object_vars($value)));
                    } elseif (is_array($value)) {
                        array_push($values, ...array_values($value));
                    }
                }
                self::assertStringNotContainsString('private-sts-token', $diagnostic);
                self::assertStringNotContainsString('private-sts-password', $diagnostic);
            }
        } finally {
            ini_set('zend.exception_ignore_args', $ignoreArgs);
        }
    }
}
