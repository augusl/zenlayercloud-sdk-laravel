# Zenlayer Cloud Laravel SDK

[![tests](https://github.com/augusl/zenlayercloud-sdk-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/augusl/zenlayercloud-sdk-laravel/actions/workflows/tests.yml)
[![License](https://img.shields.io/badge/license-Apache--2.0-blue.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/php-%5E8.2-777BB4.svg)]()
[![Laravel](https://img.shields.io/badge/laravel-11%20%7C%2012%20%7C%2013-FF2D20.svg)]()

中文 · [English](README.md)

> **非官方、社区维护的 SDK。** 本项目与 Zenlayer 公司**没有任何隶属关系**，也
> **未获得**其官方授权或背书；由社区贡献者依据 Zenlayer Cloud 的公开 OpenAPI
> 文档独立实现。Bug 反馈和功能建议提到本仓库；Zenlayer Cloud 产品问题请咨询
> [官方文档站](https://docs.console.zenlayer.com/api-reference/cn)。

为 [Zenlayer Cloud](https://www.zenlayer.com/) 提供原生的 Laravel 集成：自动注册
ServiceProvider 与 Facade、可发布的连接配置、基于 `Illuminate\Http\Client`
的传输层（开箱支持 `Http::fake()` 单测拦截）。

`v0.1.x` 覆盖**算力**产品组：

- **虚拟机 (VM)** — API 版本 `2026-04-01`，共 62 个 Action。
- **弹性算力 (ZEC)** — API 版本 `2025-09-01`，共 214 个 Action。

每个 Action 都映射为一个带强类型 Request / Response 的 PHP 方法，IDE 全程提示。

---

## 环境要求

| 组件       | 版本                     |
|------------|--------------------------|
| PHP        | `^8.2`                   |
| Laravel    | `11.x` · `12.x` · `13.x` |
| `ext-json` | 内置启用                 |
| `ext-hash` | 内置启用                 |

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
use ZenlayerCloud\Laravel\Vm\V20260401\VmClient;
use ZenlayerCloud\Laravel\Zec\V20250901\ZecClient;

// 1. Facade
$vm = ZenlayerCloud::vm();

// 2. 容器解析（默认连接）
$vm = app(VmClient::class);

// 3. 构造器注入
public function __construct(private VmClient $vm) {}
```

### 查询可用区

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Vm\V20260401\Models\DescribeZonesRequest;

$response = ZenlayerCloud::vm()->DescribeZones(new DescribeZonesRequest());

foreach ($response->response->zoneSet as $zone) {
    echo $zone->zoneId, ' ', $zone->zoneName, PHP_EOL;
}
```

### 创建虚拟机

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
$req->systemDisk                    = new SystemDisk();
$req->systemDisk->diskSize          = 50;

$resp = ZenlayerCloud::vm()->CreateInstances($req);

logger()->info('订单已下达', [
    'order'     => $resp->response->orderNumber,
    'instances' => $resp->response->instanceIdSet ?? [],
]);
```

### 弹性算力 (ZEC)

```php
use ZenlayerCloud\Laravel\Facades\ZenlayerCloud;
use ZenlayerCloud\Laravel\Zec\V20250901\Models\DescribeVpcsRequest;

$resp = ZenlayerCloud::zec()->DescribeVpcs(new DescribeVpcsRequest());

foreach ($resp->response->dataSet as $vpc) {
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
        $e->getMessage(),
    ));
}
```

异常对象提供 `$e->errorCode`（取值如 `INVALID_PARAMETER`、`NETWORK_ERROR`、
`CREDENTIAL_VALUE_MISSING`、`CONFIG_INVALID`）和 `$e->requestId`（用于日志关联）。
传输层失败（DNS、连接拒绝、TLS、超时）统一包装为 `NETWORK_ERROR`——
无需单独捕获 Laravel 的 `ConnectionException`。

开启 `retry` 后**只重试网络层失败**——HTTP 错误响应绝不重试，因此
`CreateInstances` 这类非幂等 Action 不会被重复执行。

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

切换连接：

```php
ZenlayerCloud::vm();              // default
ZenlayerCloud::vm('staging');     // 命名连接
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

self::assertSame('SEL-A', $resp->response->zoneSet[0]->zoneId);

Http::assertSent(fn ($r) => $r->header('x-zc-action')[0] === 'DescribeZones');
```

---

## 约定

- **方法名沿用 Action 原始 PascalCase**——如 `DescribeInstances`、`CreateInstances`、
  `ModifyInstancesAttribute`。这样从 Zenlayer API 文档复制方法名到 PHP 代码不会有
  大小写歧义。仓库自带的 `pint.json` 不对这些生成的客户端方法强制 PSR-12 camelCase。
- **模型是纯数据对象**——所有字段都是 public typed nullable property。未赋值的字段
  不会出现在最终发送的 JSON 里。
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

# 从上游 schema 重新生成 Client + Model 类
ZENLAYER_SCHEMA_SRC=/path/to/upstream/schema composer codegen
```

完整贡献者流程参考 [CONTRIBUTING.md](CONTRIBUTING.md)。

---

## Roadmap

首个发布周期 `v0.1.x` 覆盖 VM + ZEC。其他产品组（BMC、CCS、Traffic、ZDNS、ZGA、
ZLB、ZLS、ZOS、ZRM 等）排入后续 minor 版本，欢迎 PR。

## 安全

发现漏洞？请按 [SECURITY.md](SECURITY.md) 流程**私下**披露，**不要**直接开公开
issue。

## License

Apache-2.0 — 见 [LICENSE](LICENSE)。

## 免责声明

本项目是**非官方、社区维护**的 Laravel SDK，按现状（as-is）提供，与 Zenlayer
公司及其关联公司**无任何隶属关系**、**未获得授权**或背书。"Zenlayer" 和
"Zenlayer Cloud" 为各自商标所有人的商标；本项目仅为说明所集成的上游服务而
使用上述名称。
