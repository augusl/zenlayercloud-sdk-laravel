<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Tests\Unit;

use FilesystemIterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

final class CodegenTest extends TestCase
{
    private string $directory;

    /** @var array<string,array{string,string,string}> */
    private const SERVICES = [
        'vm' => ['20260401', '2026-04-01', 'Vm'],
        'ipt' => ['20240901', '2024-09-01', 'Ipt'],
        'zec' => ['20250901', '2025-09-01', 'Zec'],
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->directory = sys_get_temp_dir().'/zenlayer-codegen-'.bin2hex(random_bytes(8));
        mkdir($this->directory.'/bin', 0755, true);
        copy(dirname(__DIR__, 2).'/bin/codegen.php', $this->directory.'/bin/codegen.php');
    }

    protected function tearDown(): void
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->directory, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST,
        );
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        rmdir($this->directory);

        parent::tearDown();
    }

    public function test_every_action_is_generated_when_client_receiver_names_differ(): void
    {
        $this->writeSchemas('func (sdkClient2 *Client) DescribeThings(request *DescribeThingsRequest) (response *DescribeThingsResponse, err error)');

        [$exitCode, $output] = $this->runGenerator();

        self::assertSame(0, $exitCode, $output);
        foreach (self::SERVICES as [$version, , $name]) {
            $path = $this->directory.'/src/'.$name.'/V'.$version;
            $client = file_get_contents($path.'/'.$name.'Client.php');
            self::assertIsString($client);
            self::assertStringContainsString('public function StopInstances(', $client);
            self::assertStringContainsString('public function DescribeThings(', $client);
            self::assertFileExists($path.'/Models/DescribeThingsRequest.php');
            self::assertFileExists($path.'/Models/DescribeThingsResponse.php');
        }
    }

    #[DataProvider('unsupportedSignatures')]
    public function test_unsupported_client_signatures_fail_before_replacing_any_output(string $signature): void
    {
        $this->writeSchemas($signature);
        foreach (self::SERVICES as [$version, , $name]) {
            $path = $this->directory.'/src/'.$name.'/V'.$version;
            mkdir($path.'/Models', 0755, true);
            file_put_contents($path.'/'.$name.'Client.php', 'existing client');
            file_put_contents($path.'/Models/Existing.php', 'existing model');
        }

        [$exitCode, $output] = $this->runGenerator();

        self::assertSame(1, $exitCode, $output);
        self::assertStringContainsString('Unrecognized Client method signature', $output);
        foreach (self::SERVICES as [$version, , $name]) {
            $path = $this->directory.'/src/'.$name.'/V'.$version;
            self::assertSame('existing client', file_get_contents($path.'/'.$name.'Client.php'));
            self::assertSame('existing model', file_get_contents($path.'/Models/Existing.php'));
            self::assertSame([$path.'/Models/Existing.php'], glob($path.'/Models/*.php'));
        }
    }

    /** @return array<string,array{string}> */
    public static function unsupportedSignatures(): array
    {
        return [
            'request parameter changed' => [
                'func (client *Client) DescribeThings(req *DescribeThingsRequest) (response *DescribeThingsResponse, err error)',
            ],
            'response signature changed' => [
                'func (sdk *Client) DescribeThings(request *DescribeThingsRequest) (*DescribeThingsResponse, error)',
            ],
        ];
    }

    private function writeSchemas(string $lastServiceSignature): void
    {
        foreach (self::SERVICES as $service => [$version, $apiVersion]) {
            $path = $this->directory.'/schema/'.$service.$version;
            mkdir($path, 0755, true);
            file_put_contents($path.'/models.go', <<<'GO'
package sample

type StopInstancesRequest struct {
    ForceShutdown *bool `json:"forceShutdown,omitempty"`
}

type StopInstancesResponse struct {
}

type DescribeThingsRequest struct {
}

type DescribeThingsResponse struct {
}
GO);
            $signature = $service === 'zec'
                ? $lastServiceSignature
                : 'func (otherClient *Client) DescribeThings(request *DescribeThingsRequest) (response *DescribeThingsResponse, err error)';
            file_put_contents($path.'/client.go', <<<GO
package sample

const (
    SERVICE = "{$service}"
    APIVersion = "{$apiVersion}"
)

func (c *Client) StopInstances(request *StopInstancesRequest) (response *StopInstancesResponse, err error) {
    return
}

{$signature} {
    return
}
GO);
        }
    }

    /** @return array{int,string} */
    private function runGenerator(): array
    {
        $process = proc_open(
            [PHP_BINARY, $this->directory.'/bin/codegen.php', $this->directory.'/schema'],
            [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
            $pipes,
        );
        self::assertIsResource($process);
        fclose($pipes[0]);
        $output = stream_get_contents($pipes[1]).stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        return [proc_close($process), $output];
    }
}
