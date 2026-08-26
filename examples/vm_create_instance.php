<?php

/**
 * Example: create a single billable VM instance with an existing SSH key.
 *
 *     ZENLAYER_SECRET_KEY_ID=... \
 *     ZENLAYER_SECRET_KEY_PASSWORD=... \
 *     ZONE_ID=SEL-A IMAGE_ID=IMG-xxxx INSTANCE_TYPE=S8I \
 *     SUBNET_ID=subnet-xxxx KEY_ID=key-xxxx CONFIRM_CREATE=1 \
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

if (getenv('CONFIRM_CREATE') !== '1') {
    fwrite(STDERR, "This example creates a billable VM. Set CONFIRM_CREATE=1 to continue.\n");
    exit(1);
}

/** @var array<string,string> $input */
$input = [];
foreach (['ZONE_ID', 'IMAGE_ID', 'INSTANCE_TYPE', 'SUBNET_ID', 'KEY_ID'] as $name) {
    $value = getenv($name);
    if (! is_string($value) || trim($value) === '') {
        fwrite(STDERR, "Please export {$name} with a real Zenlayer resource identifier.\n");
        exit(1);
    }
    $input[$name] = trim($value);
}

$client = new VmClient(
    credential: new Credential($secretKeyId, $secretKeyPassword),
    config: new Config,
    http: new HttpClientFactory(new HttpFactory),
    signer: new Signer,
);

$req = new CreateInstancesRequest;
$req->zoneId = $input['ZONE_ID'];
$req->imageId = $input['IMAGE_ID'];
$req->instanceType = $input['INSTANCE_TYPE'];
$req->instanceCount = 1;
$req->instanceChargeType = 'PREPAID';
$req->instanceChargePrepaid = new ChargePrepaid;
$req->instanceChargePrepaid->period = 1;
$req->subnetId = $input['SUBNET_ID'];
$req->internetChargeType = 'ByBandwidth';
$req->internetMaxBandwidthOut = 1;
$req->keyId = $input['KEY_ID'];
$req->systemDisk = new SystemDisk;
$req->systemDisk->diskSize = 50;

try {
    $resp = $client->CreateInstances($req);
} catch (ZenlayerCloudSdkException $e) {
    fwrite(STDERR, "API error {$e->errorCode}: {$e->getErrorMessage()}\n");
    exit(2);
}

printf("Order: %s\n", $resp->response->orderNumber ?? '-');
printf("Instance IDs: %s\n", implode(',', $resp->response->instanceIdSet ?? []));
