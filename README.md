# Zenlayer Cloud Laravel SDK

[![tests](https://github.com/augusl/zenlayercloud-sdk-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/augusl/zenlayercloud-sdk-laravel/actions/workflows/tests.yml)
[![License](https://img.shields.io/badge/license-Apache--2.0-blue.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/php-%5E8.2-777BB4.svg)](https://www.php.net/supported-versions.php)
[![Laravel](https://img.shields.io/badge/laravel-11%20%7C%2012%20%7C%2013-FF2D20.svg)](https://laravel.com/docs/releases)

[中文文档](README-CN.md) · English

> **Unofficial, community-maintained SDK.** This package is **not** affiliated
> with or endorsed by Zenlayer Inc. It is maintained against the public
> Zenlayer Cloud OpenAPI documentation and Apache-licensed official Go/Python
> SDK sources; exact audited revisions are disclosed in [UPSTREAM.md](UPSTREAM.md).
> Bug reports and feature requests belong here; Zenlayer Cloud product
> questions belong on the [official documentation site](https://docs.console.zenlayer.com/api-reference).

A first-class Laravel package for talking to [Zenlayer Cloud](https://www.zenlayer.com/)
OpenAPI services. Designed to feel native — service providers, facades,
configurable connections, the standard `Illuminate\Http\Client` for transport,
and `Http::fake()` support out of the box.

The package currently covers these Compute and Networking services:

- **Virtual Machine (VM)** — API version `2026-04-01`, 62 actions.
- **IP Transit (IPT)** — API version `2024-09-01`, 12 actions.
- **Elastic Compute (ZEC)** — API version `2025-09-01`, 226 actions.

The generated surface contains 300 Actions and 1,043 model classes in total.
Its upstream source and known documentation differences are recorded in
[UPSTREAM.md](UPSTREAM.md).

Every Action in the supported services is exposed as a typed PHP method backed
by typed Request and Response model classes, so IDEs autocomplete the entire
surface area.

---

## Requirements

| Component  | Version                  |
|------------|--------------------------|
| PHP        | `^8.2`                   |
| Platform   | 64-bit                   |
| Composer   | `2.x`                    |
| Laravel    | `11.x` · `12.x` · `13.x` |
| `ext-json` | enabled (default)        |
| `ext-hash` | enabled (default)        |

The 64-bit requirement is intentional: the official VM/IPT/ZEC schemas contain
signed `int64` counters and limits that a 32-bit PHP integer cannot represent.

Laravel 11 remains compatibility-tested for existing applications, but its
upstream security-fix window has ended. New production deployments should use
a currently supported Laravel release.

## Installation

```bash
composer require augusl/zenlayercloud-laravel-sdk
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag=zenlayercloud-config
```

Set credentials in your `.env`. Either an AccessKey pair (HMAC signing):

```dotenv
ZENLAYER_SECRET_KEY_ID=AKID-your-key-id
ZENLAYER_SECRET_KEY_PASSWORD=your-secret-key-password
```

…or a personal access token (Bearer auth — takes precedence when set,
generate one at <https://console.zenlayer.com/accessToken>):

```dotenv
ZENLAYER_TOKEN=your-personal-access-token
```

The package supports Laravel's auto-discovery — the service provider and
the `ZenlayerCloud` facade are registered for you.

---

## Quick start

### Resolve clients

There are three equivalent ways to obtain a client:

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Ipt\V20240901\IptClient;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

// 1. Facade
$vm = ZenlayerCloud::vm();

// 2. Container resolution (defaults to the 'default' connection)
$vm = app(VmClient::class);

// 3. Constructor injection
public function __construct(private VmClient $vm) {}

// The same three access patterns apply to IPT and ZEC:
$ipt = ZenlayerCloud::ipt();
$ipt = app(IptClient::class);
```

### List availability zones

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\DescribeZonesRequest;

$response = ZenlayerCloud::vm()->DescribeZones(new DescribeZonesRequest());

foreach (($response->response?->zoneSet ?? []) as $zone) {
    echo $zone->zoneId, ' ', $zone->zoneName, PHP_EOL;
}
```

### Create a virtual machine

> `CreateInstances` creates billable resources. Replace every placeholder with
> identifiers from your own account before running it.

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\ChargePrepaid;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\CreateInstancesRequest;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\SystemDisk;

$req                                = new CreateInstancesRequest();
$req->zoneId                        = 'SEL-A';
$req->imageId                       = 'IMG-xxxx';
$req->instanceType                  = 'S8I';
$req->instanceCount                 = 1;
$req->instanceChargeType            = 'PREPAID';
$req->instanceChargePrepaid         = new ChargePrepaid();
$req->instanceChargePrepaid->period = 12;
$req->subnetId                      = 'subnet-xxxx';
$req->internetChargeType            = 'ByBandwidth';
$req->internetMaxBandwidthOut       = 1;
$req->keyId                         = 'key-xxxx'; // provide exactly one of keyId/password
$req->systemDisk                    = new SystemDisk();
$req->systemDisk->diskSize          = 50;

$resp = ZenlayerCloud::vm()->CreateInstances($req);

logger()->info('Order placed', [
    'order'     => $resp->response?->orderNumber,
    'instances' => $resp->response?->instanceIdSet ?? [],
]);
```

### IP Transit (IPT)

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Ipt\V20240901\Models\DescribeIPTransitDatacentersRequest;

$resp = ZenlayerCloud::ipt()->DescribeIPTransitDatacenters(
    new DescribeIPTransitDatacentersRequest(),
);

foreach (($resp->response?->supportSet ?? []) as $support) {
    echo $support->dataCenter?->dcId, ' ', $support->dataCenter?->dcName, PHP_EOL;
}
```

### Elastic Compute (ZEC)

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\DescribeVpcsRequest;

$resp = ZenlayerCloud::zec()->DescribeVpcs(new DescribeVpcsRequest());

foreach (($resp->response?->dataSet ?? []) as $vpc) {
    echo $vpc->vpcId, PHP_EOL;
}
```

### Error handling

Every transport- and API-level failure surfaces as one typed exception:

```php
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

try {
    $resp = ZenlayerCloud::vm()->DescribeInstances(new DescribeInstancesRequest());
} catch (ZenlayerCloudSdkException $e) {
    report($e);
    abort(502, sprintf(
        'Zenlayer error %s (request %s): %s',
        $e->errorCode,
        $e->requestId ?? '-',
        $e->getErrorMessage(),
    ));
}
```

The exception exposes `$e->errorCode` (e.g. `INVALID_PARAMETER`,
`NETWORK_ERROR`, `REQUEST_LIMIT_EXCEEDED`, `SECURITY_CHALLENGE`,
`REQUEST_BLOCKED`, `SDK_INVALID_REQUEST`, `CREDENTIAL_VALUE_MISSING`,
`CONFIG_INVALID`) and `$e->requestId` for log correlation. The raw API/SDK
message is available as `$e->errorMessage` or `$e->getErrorMessage()`;
`$e->getMessage()` includes the formatted code and request id. Transport-level failures (DNS,
connection refused, TLS, timeout) are wrapped with code `NETWORK_ERROR`;
you never need to catch Laravel's `ConnectionException` separately.

There are two deliberately separate retry policies:

- `retry` is opt-in and retries only connection-level failures. A timeout can
  happen after the server has accepted a mutating request, so enabling it may
  replay a non-idempotent Action. Keep it disabled for writes unless that risk
  is acceptable. Ordinary HTTP errors are never retried.
- `REQUEST_LIMIT_EXCEEDED` / HTTP 429 follows the official SDK behavior and
  is retried three times by default with 1s, 2s, and 4s backoff. If the API
  returns an integer `Retry-After` header, the SDK waits at least that many
  seconds. Set `rate_limit_max_retries` to `0` to disable it.

---

## Configuration

The published `config/zenlayercloud.php` file follows Laravel's "connection"
convention used by the database, cache, and mail components:

```php
return [
    'default' => env('ZENLAYER_CONNECTION', 'default'),

    'connections' => [
        'default' => [
            'secret_key_id'       => env('ZENLAYER_SECRET_KEY_ID'),
            'secret_key_password' => env('ZENLAYER_SECRET_KEY_PASSWORD'),
            'token'               => env('ZENLAYER_TOKEN'), // Bearer auth; wins over the key pair when set
            'endpoint'            => env('ZENLAYER_ENDPOINT', 'console.zenlayer.com'),
            'scheme'              => env('ZENLAYER_SCHEME', 'https'),
            'timeout'             => (int) env('ZENLAYER_TIMEOUT', 60),
            'retry'               => (bool) env('ZENLAYER_RETRY', false),
            'retry_max'           => (int) env('ZENLAYER_RETRY_MAX', 3),
            'rate_limit_max_retries' => (int) env('ZENLAYER_RATE_LIMIT_MAX_RETRIES', 3),
            'rate_limit_retry_delay_ms' => (int) env('ZENLAYER_RATE_LIMIT_RETRY_DELAY_MS', 1000),
            'debug'               => (bool) env('ZENLAYER_DEBUG', false),
            'proxy'               => env('ZENLAYER_PROXY'),
            'verify'              => env('ZENLAYER_VERIFY', true), // true | false | CA bundle path
            'request_client'      => env('ZENLAYER_REQUEST_CLIENT'),
        ],

        'staging' => [
            // a second account, used per-call: ZenlayerCloud::vm('staging')
        ],
    ],
];
```

`endpoint` accepts only `host[:port]` or a complete `http(s)://host[:port]`
URL; credentials, paths, queries, fragments, and unsupported schemes fail
fast. `debug` writes only method, URL, service, Action, and status to Laravel's
PSR-3 logger—Authorization headers and request/response bodies are never logged.

Switch between connections with the optional argument to the manager:

```php
ZenlayerCloud::vm();              // 'default'
ZenlayerCloud::vm('staging');     // named connection
ZenlayerCloud::ipt('production'); // any name from the 'connections' map
ZenlayerCloud::zec('production'); // any name from the 'connections' map
```

---

## Testing the SDK in your app

The transport layer is built on `Illuminate\Http\Client`, so Laravel's
built-in `Http::fake()` is the only thing you need to mock the API:

```php
use Illuminate\Support\Facades\Http;
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\DescribeZonesRequest;

Http::fake([
    'console.zenlayer.com/*' => Http::response([
        'requestId' => 'r-1',
        'response'  => [
            'requestId' => 'r-1',
            'zoneSet'   => [['zoneId' => 'SEL-A', 'zoneName' => 'Seoul A']],
        ],
    ], 200),
]);

$resp = ZenlayerCloud::vm()->DescribeZones(new DescribeZonesRequest());

self::assertSame('SEL-A', $resp->response?->zoneSet[0]->zoneId);

Http::assertSent(fn ($r) => $r->header('x-zc-action')[0] === 'DescribeZones');
```

---

## Conventions

- **Method names follow the upstream Action names (PascalCase)** — e.g.
  `DescribeInstances`, `CreateInstances`, `ModifyInstancesAttribute`. This
  keeps copy-paste from the Zenlayer Cloud API reference unambiguous. The
  shipped `pint.json` does not enforce PSR-12 camelCase on those generated
  client methods.
- **Models are Laravel-friendly data objects** — public typed nullable
  properties for every field, implementing `Arrayable` and `JsonSerializable`.
  Null fields are omitted from the JSON body sent over the wire.
- **Responses come in wrappers** — every Action returns a
  `XxxResponse` whose `requestId` lives at the top level and whose payload
  lives under `response`. Access fields via `$resp->response->...`.

---

## Local development

```bash
# Install dev dependencies
composer install

# Run the test suite (Orchestra Testbench + PHPUnit)
composer test

# Run code-style checks
composer lint
composer lint:fix

# Run static analysis
composer analyse

# Regenerate from the official Go SDK's `zenlayercloud` directory
composer codegen -- /path/to/zenlayercloud-sdk-go/zenlayercloud
```

See [CONTRIBUTING.md](CONTRIBUTING.md) for the full contributor workflow.

---

## Roadmap

The current release line covers VM + IPT + ZEC. Other Zenlayer Cloud
product groups (BMC, CCS, Traffic, ZDNS, ZGA, ZLB, ZLS, ZOS, ZRM, etc.) are
deferred to subsequent minor versions; contributions are welcome.

## Security

Found a vulnerability? Please follow the responsible-disclosure process
described in [SECURITY.md](SECURITY.md) — do not file a public issue.

## License

Apache-2.0 — see [LICENSE](LICENSE) and [NOTICE](NOTICE).

## Disclaimer

This is an **unofficial, community-maintained** Laravel SDK. It is provided
as-is, with no affiliation with, sponsorship from, or endorsement by
Zenlayer Inc. or any of its subsidiaries. "Zenlayer" and "Zenlayer Cloud"
are trademarks of their respective owners; this project uses those names
solely to describe the upstream service it integrates with.
