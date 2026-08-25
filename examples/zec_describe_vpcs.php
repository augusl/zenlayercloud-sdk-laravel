<?php

/**
 * Example: ZEC — list VPCs as a smoke test.
 *
 *     ZENLAYER_SECRET_KEY_ID=... \
 *     ZENLAYER_SECRET_KEY_PASSWORD=... \
 *     php examples/zec_describe_vpcs.php
 */

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Http\Client\Factory as HttpFactory;
use ZenlayerCloud\Laravel\Common\Config;
use ZenlayerCloud\Laravel\Common\Credential;
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;
use ZenlayerCloud\Laravel\Common\Http\HttpClientFactory;
use ZenlayerCloud\Laravel\Common\Signer;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\DescribeVpcsRequest;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

$secretKeyId = getenv('ZENLAYER_SECRET_KEY_ID') ?: '';
$secretKeyPassword = getenv('ZENLAYER_SECRET_KEY_PASSWORD') ?: '';

if ($secretKeyId === '' || $secretKeyPassword === '') {
    fwrite(STDERR, "Please export ZENLAYER_SECRET_KEY_ID and ZENLAYER_SECRET_KEY_PASSWORD.\n");
    exit(1);
}

$client = new ZecClient(
    credential: new Credential($secretKeyId, $secretKeyPassword),
    config: new Config,
    http: new HttpClientFactory(new HttpFactory),
    signer: new Signer,
);

try {
    $resp = $client->DescribeVpcs(new DescribeVpcsRequest);
} catch (ZenlayerCloudSdkException $e) {
    fwrite(STDERR, "API error {$e->errorCode}: {$e->getErrorMessage()}\n");
    exit(2);
}

printf("Total VPCs: %d\n", $resp->response->totalCount ?? 0);
foreach (($resp->response->dataSet ?? []) as $vpc) {
    printf("%-25s  %s\n", $vpc->vpcId ?? '-', $vpc->vpcName ?? '-');
}
