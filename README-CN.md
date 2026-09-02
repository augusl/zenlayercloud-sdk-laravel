# Zenlayer Cloud Laravel SDK

[![tests](https://github.com/augusl/zenlayercloud-sdk-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/augusl/zenlayercloud-sdk-laravel/actions/workflows/tests.yml)
[![License](https://img.shields.io/badge/license-Apache--2.0-blue.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/php-%5E8.2-777BB4.svg)](https://www.php.net/supported-versions.php)
[![Laravel](https://img.shields.io/badge/laravel-11%20%7C%2012%20%7C%2013-FF2D20.svg)](https://laravel.com/docs/releases)

中文 · [English](README.md)

> **非官方、社区维护的 SDK。** 本项目与 Zenlayer 公司**没有任何隶属关系**，也
> **未获得**其官方授权或背书；项目依据 Zenlayer Cloud 的公开 OpenAPI 文档及
> Apache-2.0 授权的官方 Go/Python SDK 源码维护，审计版本完整记录于
> [UPSTREAM.md](UPSTREAM.md)。
> Bug 反馈和功能建议提到本仓库；Zenlayer Cloud 产品问题请咨询
> [官方文档站](https://docs.console.zenlayer.com/api-reference)。

为 [Zenlayer Cloud](https://www.zenlayer.com/) 提供原生的 Laravel 集成：自动注册
ServiceProvider 与 Facade、可发布的连接配置、基于 `Illuminate\Http\Client`
的传输层（开箱支持 `Http::fake()` 单测拦截）。

当前覆盖以下算力与网络服务：

- **虚拟机 (VM)** — API 版本 `2026-04-01`，共 62 个 Action。
- **IP Transit (IPT)** — API 版本 `2024-09-01`，共 12 个 Action。
- **弹性算力 (ZEC)** — API 版本 `2025-09-01`，共 226 个 Action。

当前生成代码合计包含 300 个 Action、1,043 个模型类。上游版本与已知文档差异记录在
[UPSTREAM.md](UPSTREAM.md)。

支持范围内的每个 Action 都映射为一个带强类型 Request / Response 的 PHP 方法，
IDE 全程提示。

---

## 环境要求

| 组件       | 版本                     |
|------------|--------------------------|
| PHP        | `^8.2`                   |
| 运行平台   | 64 位                    |
| Composer   | `2.x`                    |
| Laravel    | `11.x` · `12.x` · `13.x` |
| `ext-json` | 内置启用                 |
| `ext-hash` | 内置启用                 |

64 位要求是有意保留的：官方 VM/IPT/ZEC schema 包含多处有符号 `int64` 计数器和限额，
32 位 PHP 整数无法无损表示。

Laravel 11 仍为已有项目保留兼容性测试，但其官方安全维护期已经结束；新生产项目应使用
仍在官方支持期内的 Laravel 版本。

## 安装

```bash
composer require augusl/zenlayercloud-laravel-sdk
```

发布配置文件：

```bash
php artisan vendor:publish --tag=zenlayercloud-config
```

`.env` 写入凭证。可以用 AccessKey 密钥对（HMAC 签名）：

```dotenv
ZENLAYER_SECRET_KEY_ID=AKID-你的密钥ID
ZENLAYER_SECRET_KEY_PASSWORD=你的密钥密码
```

也可以用个人访问令牌（Bearer 认证，设置后优先于密钥对，
在 <https://console.zenlayer.com/accessToken> 生成）：

```dotenv
ZENLAYER_TOKEN=你的个人访问令牌
```

Laravel package discovery 会自动注册 ServiceProvider 和 `ZenlayerCloud` Facade。

---

## 快速上手

### 三种取客户端的方式

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Ipt\V20240901\IptClient;
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

// 1. Facade
$vm = ZenlayerCloud::vm();

// 2. 容器解析（默认连接）
$vm = app(VmClient::class);

// 3. 构造器注入
public function __construct(private VmClient $vm) {}

// IPT 和 ZEC 同样支持以上三种方式：
$ipt = ZenlayerCloud::ipt();
$ipt = app(IptClient::class);
```

### 查询可用区

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\DescribeZonesRequest;

$response = ZenlayerCloud::vm()->DescribeZones(new DescribeZonesRequest());

foreach (($response->response?->zoneSet ?? []) as $zone) {
    echo $zone->zoneId, ' ', $zone->zoneName, PHP_EOL;
}
```

### 创建虚拟机

> `CreateInstances` 会创建计费资源。调用前请将所有占位符替换为你自己账号中的真实资源 ID。

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
$req->keyId                         = 'key-xxxx'; // keyId/password 必须且只能提供一个
$req->systemDisk                    = new SystemDisk();
$req->systemDisk->diskSize          = 50;

$resp = ZenlayerCloud::vm()->CreateInstances($req);

logger()->info('订单已下达', [
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

### 弹性算力 (ZEC)

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\DescribeVpcsRequest;

$resp = ZenlayerCloud::zec()->DescribeVpcs(new DescribeVpcsRequest());

foreach (($resp->response?->dataSet ?? []) as $vpc) {
    echo $vpc->vpcId, PHP_EOL;
}
```

### 错误处理

所有传输层与 API 错误统一抛 `ZenlayerCloudSdkException`：

```php
use ZenlayerCloud\Laravel\Common\Exception\ZenlayerCloudSdkException;

try {
    $resp = ZenlayerCloud::vm()->DescribeInstances(new DescribeInstancesRequest());
} catch (ZenlayerCloudSdkException $e) {
    report($e);
    abort(502, sprintf(
        'Zenlayer 错误 %s (RequestId %s): %s',
        $e->errorCode,
        $e->requestId ?? '-',
        $e->getErrorMessage(),
    ));
}
```

异常对象提供 `$e->errorCode`（取值如 `INVALID_PARAMETER`、`NETWORK_ERROR`、
`REQUEST_LIMIT_EXCEEDED`、`SECURITY_CHALLENGE`、`REQUEST_BLOCKED`、
`SDK_INVALID_REQUEST`、`CREDENTIAL_VALUE_MISSING`、`CONFIG_INVALID`）和
`$e->requestId`（用于日志关联）。API/SDK 原始错误文本可通过 `$e->errorMessage`
或 `$e->getErrorMessage()` 读取；`$e->getMessage()` 是包含错误码和 RequestId 的完整格式。
传输层失败（DNS、连接拒绝、TLS、超时）统一包装为 `NETWORK_ERROR`——
无需单独捕获 Laravel 的 `ConnectionException`。

重试分为两套互不混淆的策略：

- `retry` 默认关闭，开启后只重试连接层失败。但超时可能发生在服务端已经接收写请求
  之后，因此开启它仍可能重复执行非幂等 Action；写操作只有在能接受该风险时才应开启。
  普通 HTTP 错误不会自动重试。
- `REQUEST_LIMIT_EXCEEDED` / HTTP 429 与官方 SDK 一致，默认额外重试 3 次，
  退避时间为 1、2、4 秒；若响应提供整数秒 `Retry-After`，实际等待时间不会短于
  该值。将 `rate_limit_max_retries` 设为 `0` 可关闭。

---

## 配置

发布出来的 `config/zenlayercloud.php` 遵循 Laravel database/cache/mail 一致的
"connection" 约定：

```php
return [
    'default' => env('ZENLAYER_CONNECTION', 'default'),

    'connections' => [
        'default' => [
            'secret_key_id'       => env('ZENLAYER_SECRET_KEY_ID'),
            'secret_key_password' => env('ZENLAYER_SECRET_KEY_PASSWORD'),
            'token'               => env('ZENLAYER_TOKEN'), // Bearer 认证；设置后优先于密钥对
            'endpoint'            => env('ZENLAYER_ENDPOINT', 'console.zenlayer.com'),
            'scheme'              => env('ZENLAYER_SCHEME', 'https'),
            'timeout'             => (int) env('ZENLAYER_TIMEOUT', 60),
            'retry'               => (bool) env('ZENLAYER_RETRY', false),
            'retry_max'           => (int) env('ZENLAYER_RETRY_MAX', 3),
            'rate_limit_max_retries' => (int) env('ZENLAYER_RATE_LIMIT_MAX_RETRIES', 3),
            'rate_limit_retry_delay_ms' => (int) env('ZENLAYER_RATE_LIMIT_RETRY_DELAY_MS', 1000),
            'debug'               => (bool) env('ZENLAYER_DEBUG', false),
            'proxy'               => env('ZENLAYER_PROXY'),
            'verify'              => env('ZENLAYER_VERIFY', true), // true | false | CA 证书路径
            'request_client'      => env('ZENLAYER_REQUEST_CLIENT'),
        ],

        'staging' => [
            // 第二套账号，按调用切换：ZenlayerCloud::vm('staging')
        ],
    ],
];
```

`endpoint` 仅接受 `host[:port]` 或完整的 `http(s)://host[:port]`；账号信息、路径、
query、fragment 和不支持的 scheme 会直接报配置错误。`debug` 只向 Laravel 的
PSR-3 logger 记录 method、URL、service、Action 和状态码，绝不记录 Authorization
或请求/响应正文。

切换连接：

```php
ZenlayerCloud::vm();              // default
ZenlayerCloud::vm('staging');     // 命名连接
ZenlayerCloud::ipt('production'); // connections 配置中的任意 key
ZenlayerCloud::zec('production'); // connections 配置中的任意 key
```

---

## 在你自己的项目里测试

传输层基于 `Illuminate\Http\Client`，因此 Laravel 自带的 `Http::fake()` 就足够
mock 全部交互：

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

## 约定

- **方法名沿用 Action 原始 PascalCase**——如 `DescribeInstances`、`CreateInstances`、
  `ModifyInstancesAttribute`。这样从 Zenlayer API 文档复制方法名到 PHP 代码不会有
  大小写歧义。仓库自带的 `pint.json` 不对这些生成的客户端方法强制 PSR-12 camelCase。
- **模型是 Laravel 友好的数据对象**——所有字段都是 public typed nullable property，
  并实现 `Arrayable` 与 `JsonSerializable`。未赋值字段不会出现在最终 JSON 里。
- **响应统一为包装对象**——每个 Action 返回 `XxxResponse`，顶层有 `requestId`，业务字段在
  `response` 嵌套对象里。访问示例：`$resp->response->...`。

---

## 本地开发

```bash
# 安装开发依赖
composer install

# 跑测试套件（Orchestra Testbench + PHPUnit）
composer test

# 代码风格检查
composer lint
composer lint:fix

# 静态分析
composer analyse

# 从官方 Go SDK 的 zenlayercloud 目录重新生成 Client + Model
composer codegen -- /path/to/zenlayercloud-sdk-go/zenlayercloud
```

完整贡献者流程参考 [CONTRIBUTING.md](CONTRIBUTING.md)。

---

## Roadmap

当前发布周期覆盖 VM + IPT + ZEC。其他产品组（BMC、CCS、Traffic、ZDNS、ZGA、
ZLB、ZLS、ZOS、ZRM 等）排入后续 minor 版本，欢迎 PR。

## 安全

发现漏洞？请按 [SECURITY.md](SECURITY.md) 流程**私下**披露，**不要**直接开公开
issue。

## License

Apache-2.0 — 见 [LICENSE](LICENSE) 与 [NOTICE](NOTICE)。

## 免责声明

本项目是**非官方、社区维护**的 Laravel SDK，按现状（as-is）提供，与 Zenlayer
公司及其关联公司**无任何隶属关系**、**未获得授权**或背书。"Zenlayer" 和
"Zenlayer Cloud" 为各自商标所有人的商标；本项目仅为说明所集成的上游服务而
使用上述名称。
