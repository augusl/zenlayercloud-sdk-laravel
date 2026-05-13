<?php

/**
 * Example: list VM instances using the Laravel SDK outside the Laravel
 * framework (manual wiring, useful as a smoke test against the real API).
 *
 *     ZENLAYER_SECRET_KEY_ID=AKID-... \
 *     ZENLAYER_SECRET_KEY_PASSWORD=... \
 *     php examples/vm_describe_instances.php
 *
 * Inside a real Laravel application use the Facade instead:
 *
 *     ZenlayerCloud::vm()->DescribeInstances($req);
 */

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Http\Client\Factory as HttpFactory;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\DescribeInstancesRequest;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;

$secretKeyId = getenv('ZENLAYER_SECRET_KEY_ID') ?: '';
$secretKeyPassword = getenv('ZENLAYER_SECRET_KEY_PASSWORD') ?: '';

if ($secretKeyId === '' || $secretKeyPassword === '') {
    fwrite(STDERR, "Please export ZENLAYER_SECRET_KEY_ID and ZENLAYER_SECRET_KEY_PASSWORD.\n");
    exit(1);
}

$client = new VmClient(
    credential: new Credential($secretKeyId, $secretKeyPassword),
    config: new Config(timeout: 30),
    http: new HttpClientFactory(new HttpFactory),
    signer: new Signer,
);

$request = new DescribeInstancesRequest;
$request->pageNum = 1;
$request->pageSize = 20;

try {
    $response = $client->DescribeInstances($request);
} catch (ZenlayerCloudSdkException $e) {
    fwrite(STDERR, sprintf("API error %s: %s (request %s)\n", $e->errorCode, $e->getMessage(), $e->requestId ?? '-'));
    exit(2);
}

printf("Total: %d\n", $response->response->totalCount ?? 0);
foreach (($response->response->dataSet ?? []) as $instance) {
    printf(
        "%-25s  %-15s  %-12s  %s\n",
        $instance->instanceId ?? '-',
        $instance->instanceName ?? '-',
        $instance->instanceStatus ?? '-',
        $instance->zoneId ?? '-',
    );
}
