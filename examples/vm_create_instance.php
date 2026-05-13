<?php

/**
 * Example: create a single VM instance.
 *
 *     ZENLAYER_SECRET_KEY_ID=... \
 *     ZENLAYER_SECRET_KEY_PASSWORD=... \
 *     ZONE_ID=SEL-A IMAGE_ID=IMG-xxxx \
 *     php examples/vm_create_instance.php
 */

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Http\Client\Factory as HttpFactory;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\ChargePrepaid;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\CreateInstancesRequest;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\SystemDisk;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;

$secretKeyId = getenv('ZENLAYER_SECRET_KEY_ID') ?: '';
$secretKeyPassword = getenv('ZENLAYER_SECRET_KEY_PASSWORD') ?: '';

if ($secretKeyId === '' || $secretKeyPassword === '') {
    fwrite(STDERR, "Please export ZENLAYER_SECRET_KEY_ID and ZENLAYER_SECRET_KEY_PASSWORD.\n");
    exit(1);
}

$client = new VmClient(
    credential: new Credential($secretKeyId, $secretKeyPassword),
    config: new Config,
    http: new HttpClientFactory(new HttpFactory),
    signer: new Signer,
);

$req = new CreateInstancesRequest;
$req->zoneId = getenv('ZONE_ID') ?: 'SEL-A';
$req->imageId = getenv('IMAGE_ID') ?: 'IMG-xxxx';
$req->instanceType = getenv('INSTANCE_TYPE') ?: 'S8I';
$req->instanceCount = 1;
$req->instanceChargeType = 'PREPAID';
$req->instanceChargePrepaid = new ChargePrepaid;
$req->instanceChargePrepaid->period = 1;
$req->systemDisk = new SystemDisk;
$req->systemDisk->diskSize = 50;
$req->password = bin2hex(random_bytes(8)).'_Aa1!';

try {
    $resp = $client->CreateInstances($req);
} catch (ZenlayerCloudSdkException $e) {
    fwrite(STDERR, "API error {$e->errorCode}: {$e->getMessage()}\n");
    exit(2);
}

printf("Order: %s\n", $resp->response->orderNumber ?? '-');
printf("Instance IDs: %s\n", implode(',', $resp->response->instanceIdSet ?? []));
