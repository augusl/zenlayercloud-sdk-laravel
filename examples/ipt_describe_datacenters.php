<?php

/**
 * Example: IPT — list connectable IP Transit datacenters as a read-only smoke test.
 *
 *     ZENLAYER_SECRET_KEY_ID=... \
 *     ZENLAYER_SECRET_KEY_PASSWORD=... \
 *     php examples/ipt_describe_datacenters.php
 */

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Http\Client\Factory as HttpFactory;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Ipt\V20240901\IptClient;
use ZenlayerCloud\Laravel\Ipt\V20240901\Models\DescribeIPTransitDatacentersRequest;

$secretKeyId = getenv('ZENLAYER_SECRET_KEY_ID') ?: '';
$secretKeyPassword = getenv('ZENLAYER_SECRET_KEY_PASSWORD') ?: '';

if ($secretKeyId === '' || $secretKeyPassword === '') {
    fwrite(STDERR, "Please export ZENLAYER_SECRET_KEY_ID and ZENLAYER_SECRET_KEY_PASSWORD.\n");
    exit(1);
}

$client = new IptClient(
    credential: new Credential($secretKeyId, $secretKeyPassword),
    config: new Config,
    http: new HttpClientFactory(new HttpFactory),
    signer: new Signer,
);

try {
    $response = $client->DescribeIPTransitDatacenters(new DescribeIPTransitDatacentersRequest);
} catch (ZenlayerCloudSdkException $e) {
    fwrite(STDERR, "API error {$e->errorCode}: {$e->getErrorMessage()}\n");
    exit(2);
}

foreach (($response->response->supportSet ?? []) as $support) {
    $datacenter = $support->dataCenter;
    printf("%-20s  %s\n", $datacenter->dcId ?? '-', $datacenter->dcName ?? '-');
}
