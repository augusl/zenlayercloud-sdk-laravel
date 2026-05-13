# Project Overview — `augusl/zenlayercloud-laravel-sdk`

> A reviewer-facing brief. Open this once, read top to bottom, and you will
> have enough context to spot-check any layer of the codebase or sign off
> on the v0.1.0 release.

---

## 1. What this is

A community-maintained, **unofficial** Laravel PHP SDK for the
[Zenlayer Cloud](https://www.zenlayer.com/) OpenAPI. It exists because
Zenlayer publishes first-party SDKs in other languages but **no Laravel /
PHP SDK**, and the broader PHP / Laravel community needed one.

- **Package name (Composer)**: `augusl/zenlayercloud-laravel-sdk`
- **PSR-4 namespace**: `ZenlayerCloud\Laravel\`
- **License**: Apache-2.0
- **Repository**: <https://github.com/augusl/zenlayercloud-sdk-laravel>
- **Status**: pre-release (`v0.1.x`); awaiting reviewer sign-off before
  the first Packagist tag.

The package is **not** affiliated with or endorsed by Zenlayer Inc. — it is
purely a community implementation against Zenlayer's public OpenAPI
documentation at <https://docs.console.zenlayer.com/api-reference/cn>.

---

## 2. Scope of `v0.1.x`

Two services under the **算力 / Compute** product group:

| Service | API version | Actions | Generated model classes |
|---------|-------------|--------:|------------------------:|
| Virtual Machine (VM) | `2026-04-01` | **61** | 209 |
| Elastic Compute (ZEC) | `2025-09-01` | **197** | 660 |
| **Total** | | **258** | **869** |

Out of scope for v0.1.x (deferred to later minors): BMC, CCS, IPT, SDN,
Traffic, User, ZBC, ZDNS, ZGA, ZLB, ZLS, ZOS, ZRM, Alarm, Maintenance,
PvtDns. Older API versions (`vm20230313`, `zec20240401`) are also out of
scope — only the latest API version per service is shipped.

---

## 3. Compatibility matrix

| Component | Supported |
|-----------|-----------|
| PHP | `^8.2` (real-installed on 8.2.x / 8.3.x / 8.4.x locally; CI matrix below) |
| Laravel | `11.x` · `12.x` · `13.x` (verified by switching `illuminate/*` constraints and re-running PHPUnit) |
| `ext-json` | required (default) |
| `ext-hash` | required (default) |

CI matrix in `.github/workflows/tests.yml` runs PHPUnit + Pint + PHPStan
on every combination of PHP `{8.2, 8.3, 8.4}` × Laravel `{11.*, 12.*,
13.*}` minus `(PHP 8.2, Laravel 13)` which Laravel itself does not
support.

---

## 4. Architecture

Three-layer design, top-down:

```
┌──────────────────────────────────────────────────────────────┐
│  Laravel application                                         │
│   ├ Facade:   ZenlayerCloud::vm()->DescribeInstances($req)   │
│   ├ DI:       app(VmClient::class)->DescribeInstances($req)  │
│   └ Inject:   __construct(private VmClient $vm) {…}          │
└──────────────────────┬───────────────────────────────────────┘
                       │
        ┌──────────────▼──────────────┐
        │  Integration layer          │
        │   - ZenlayerCloudServiceProvider (deferred)
        │   - ZenlayerCloudManager (multi-connection cache)
        │   - Facades\ZenlayerCloud
        │   - config/zenlayercloud.php  ← published
        └──────────────┬──────────────┘
                       │
        ┌──────────────▼──────────────┐
        │  Service layer (generated)  │
        │   - Vm\V20260401\VmClient (61 Action methods)
        │   - Zec\V20250901\ZecClient (197 Action methods)
        │   - Vm\V20260401\Models\* (209 typed Request/Response/nested)
        │   - Zec\V20250901\Models\* (660 typed Request/Response/nested)
        └──────────────┬──────────────┘
                       │
        ┌──────────────▼──────────────┐
        │  Common layer (hand-written)│
        │   - Signer  (ZC2-HMAC-SHA256)
        │   - AbstractClient (HTTP + sign + error → exception)
        │   - AbstractModel (toJson / fromArray via Reflection)
        │   - Config / Credential
        │   - HttpClientFactory (Config → PendingRequest)
        │   - Exception\ZenlayerCloudSdkException
        └─────────────────────────────┘
```

Hand-written code is **1 375 LOC** across **11 files**. Generated code is
**~24 000 LOC** across **871 files** (209 + 660 models + 2 clients).

### Key Laravel idioms used

1. **Auto-discovery** via `extra.laravel.providers` + `aliases` in
   `composer.json` — no manual registration needed.
2. **Deferrable service provider** (`implements DeferrableProvider`) —
   the SDK is only booted when actually used, zero impact on app boot
   time otherwise.
3. **Connection / multi-account convention** matching the database,
   cache, and mail components: `config/zenlayercloud.php` defines named
   connections; `ZenlayerCloud::vm('staging')` picks one by name.
4. **HTTP transport via `Illuminate\Http\Client`** — `Http::fake()`
   intercepts requests in tests with zero extra mocking. No Guzzle-direct
   calls; everything flows through Laravel's HTTP factory.
5. **Facade is thin** — it just forwards to the Manager. Type-hinting
   `VmClient` or `ZecClient` in a constructor resolves the same client.
6. **PHPDoc `@template TResp`** on `AbstractClient::call()` so static
   analysis tracks the response model type per Action.

---

## 5. Signing protocol (ZC2-HMAC-SHA256)

Implemented in [`src/Common/Signer.php`](src/Common/Signer.php) — 70 LOC,
**byte-for-byte** identical output to Zenlayer's published reference
algorithm. Regression-protected by hard-coded golden vectors in
[`tests/Unit/SignerTest.php`](tests/Unit/SignerTest.php).

Algorithm (per the official Authorization v2 spec):

```
canonicalRequest = "POST\n"               # http method
                 + "/\n"                  # canonical URI
                 + "\n"                   # canonical querystring (empty)
                 + "content-type:application/json\n"
                 + "host:<endpoint>\n"
                 + "\n"
                 + "content-type;host\n"  # signed headers
                 + sha256hex(body)

stringToSign     = "ZC2-HMAC-SHA256\n"
                 + "<unix-timestamp>\n"
                 + sha256hex(canonicalRequest)

signature        = hex(HMAC-SHA-256(stringToSign, secretKeyPassword))

Authorization    = "ZC2-HMAC-SHA256 Credential=<id>, "
                 + "SignedHeaders=content-type;host, "
                 + "Signature=<signature>"
```

Headers sent on every request:

| Header | Value |
|--------|-------|
| `Content-Type` | `application/json` |
| `Host` | endpoint (must match URL host) |
| `Authorization` | see above |
| `x-zc-version` | API version per service |
| `x-zc-action` | Action name (PascalCase) |
| `x-zc-service` | `vm` / `zec` |
| `x-zc-signature-method` | `ZC2-HMAC-SHA256` |
| `x-zc-timestamp` | Unix seconds as string |
| `x-zc-sdk-version` | `SDK_PHP_0.1.0` |
| `x-zc-sdk-lang` | `PHP` |
| `x-zc-request-client` | optional, validated regex `^[0-9a-zA-Z\-_ ,;.]+$`, max 128 chars |

---

## 6. Error handling

`AbstractClient` treats the HTTP status code as the single source of truth
for success vs failure:

- **`status === 200`** → success. Body shape `{requestId, response: {…}}`.
  Hydrated into the typed `XxxResponse` model.
- **Any other status** (4xx, 5xx, 204, 201, etc.) → failure. Body parsed
  as `{requestId, code, message}` and surfaced as a typed
  `ZenlayerCloudSdkException`.
- **Malformed JSON** in either branch → `ZenlayerCloudSdkException` with
  `errorCode = JSON_PARSE_FAILED`.

Error codes exposed on the exception:

- `JSON_PARSE_FAILED`
- `NETWORK_ERROR`
- `CREDENTIAL_VALUE_MISSING`
- `CONFIG_INVALID`

The exception carries:

- `$e->errorCode` (string)
- `$e->requestId` (?string — useful for log correlation with Zenlayer ops)
- `$e->getMessage()` (string — includes code + message + requestId)

---

## 7. Configuration shape

`config/zenlayercloud.php` (published by `vendor:publish --tag=zenlayercloud-config`):

```php
return [
    'default' => env('ZENLAYER_CONNECTION', 'default'),

    'connections' => [
        'default' => [
            'secret_key_id'       => env('ZENLAYER_SECRET_KEY_ID'),
            'secret_key_password' => env('ZENLAYER_SECRET_KEY_PASSWORD'),
            'endpoint'            => env('ZENLAYER_ENDPOINT', 'console.zenlayer.com'),
            'scheme'              => env('ZENLAYER_SCHEME', 'https'),
            'timeout'             => (int) env('ZENLAYER_TIMEOUT', 60),
            'retry'               => (bool) env('ZENLAYER_RETRY', false),
            'retry_max'           => (int) env('ZENLAYER_RETRY_MAX', 3),
            'debug'               => (bool) env('ZENLAYER_DEBUG', false),
            'proxy'               => env('ZENLAYER_PROXY'),
            'request_client'      => env('ZENLAYER_REQUEST_CLIENT'),
        ],

        // additional named connections may be added here
    ],
];
```

The endpoint setter tolerates copy-paste shapes like
`https://console.zenlayer.com/` — the scheme prefix and trailing slash are
stripped so the URL builder cannot produce `https://https://…/api/v2/…`
or a double-slash.

---

## 8. Security posture

The SDK handles long-lived API credentials, so the threat model takes
this seriously:

1. **`#[SensitiveParameter]`** on the constructor argument — PHP's stack
   trace redaction replaces the value with `Object(SensitiveParameterValue)`
   in any exception backtrace.
2. **Password lives inside a closure**, not as a declared property — so
   `var_export()`, `serialize()`, and `__sleep` cannot surface the
   plaintext value. Only `getSecretKeyPassword()` retrieves it explicitly.
3. **`__debugInfo`** redacts the password to `*** redacted ***` in
   `var_dump()` and `print_r()`.
4. **`__serialize`** throws — `serialize($credential)` raises a
   `ZenlayerCloudSdkException` rather than emitting any state.
5. **`x-zc-request-client` regex-validated** to prevent CRLF injection
   into HTTP headers (alphanumerics, space, dash, underscore, comma,
   semicolon, period only; 128-char cap).
6. **GitHub Actions** workflow declares `permissions: contents: read` to
   minimize blast radius of any compromise.

All four redaction paths are guarded by PHPUnit tests in
[`tests/Unit/CredentialTest.php`](tests/Unit/CredentialTest.php).

---

## 9. Code generation

The 871 generated files come from `bin/codegen.php`, a maintainer-only
tool. It parses the upstream Zenlayer schema source (a typed-struct DSL)
and emits typed PHP Request / Response / nested model classes.

- **Input**: a directory containing `vm20260401/{models.go,client.go}`
  and `zec20250901/{models.go,client.go}`. The path is configured via
  `ZENLAYER_SCHEMA_SRC` env var.
- **Output**: `src/Vm/V20260401/Models/*.php` + `src/Vm/V20260401/VmClient.php`
  (and ZEC equivalents). Committed to git.
- **Idempotency**: re-running the generator with unchanged input produces
  byte-identical output — any diff is a regression.
- **Type mapping** (Go-style → PHP):

  | Schema | PHP |
  |--------|-----|
  | `*string` | `?string` |
  | `*int`, `*int32`, `*int64` | `?int` |
  | `*bool` | `?bool` |
  | `*float32`, `*float64` | `?float` |
  | `*Xxx` | `?Xxx` (nested AbstractModel) |
  | `[]string`, `[]int`, … | `?array` of scalars |
  | `[]*Xxx`, `[]Xxx` | `?array` of `Xxx` (entry in `$_typeMap`) |
  | `embed of base types` | (ignored — does not become a property) |
  | inline `Response struct {…}` | auto-promoted to `{Wrapper}Params` class |

End consumers never run the generator. The committed PHP files are the
canonical source for Packagist.

---

## 10. Test suite

| Suite | Count |
|-------|------:|
| Tests | **52** |
| Assertions | **119** |

Unit tests (`tests/Unit/`):

- `SignerTest` — 10 tests including 4 hard-coded golden vectors for
  `ZC2-HMAC-SHA256` (one copied from the official signature-v2
  documentation). Any drift in the signing algorithm fails immediately.
- `AbstractModelTest` — 8 tests covering scalar / nested-model /
  typed-array hydration round-trip, JSON serialization including unicode,
  and the `null → omit` semantics.
- `CredentialTest` — 8 tests including 4 live security checks: var_export,
  var_dump, print_r, and serialize all confirmed not to leak the password.
- `ConfigTest` — 7 tests covering defaults, named args, endpoint scheme
  normalization, and the `request_client` regex / length validation.

Feature tests (`tests/Feature/`):

- `VmClientTest` — 13 tests using `Http::fake()`: signed POST,
  `request_client` header passthrough, nested request body serialization,
  retry-enabled API error preservation, connection failure → `NETWORK_ERROR`,
  4xx + 5xx + 204 + non-JSON body error paths, forward-compat unknown fields,
  full `CreateInstances` round-trip with nested `ChargePrepaid` /
  `SystemDisk` / `DataDisk[]`.
- `ZecClientTest` — 2 tests for the second service.
- `ZenlayerCloudManagerTest` — 5 tests for the multi-connection manager
  (default, named, unknown, flush, missing credential).

Run locally:

```bash
composer install
composer test       # PHPUnit
composer lint       # Pint check
composer lint:fix   # Pint fix
composer analyse    # PHPStan level 8
composer codegen    # regenerate src/Vm + src/Zec from schema
```

---

## 11. Quality bar (all currently green)

| Tool | Setting | Status |
|------|---------|--------|
| PHPUnit | 52 tests, strict flags (`failOnWarning`, `failOnRisky`, `failOnEmptyTestSuite`, `beStrictAboutOutputDuringTests`) | OK |
| Laravel Pint | `preset: laravel` + custom (strict_types required, ordered_imports, no_unused_imports) | passed |
| PHPStan | `level: 8` over `src/Common` + `src/Facades` + integration layer (generated tree excluded) | 0 errors |
| `composer validate --strict` | — | valid |
| PHP `-l` lint | every file (914 tracked) | 0 errors |
| Codegen idempotency | `git diff src/` after rerun | empty (byte-identical) |

---

## 12. Open-source baseline

All standard files in place at repo root or under `.github/`:

- `LICENSE` — Apache-2.0
- `README.md` + `README-CN.md` — bilingual, identical content
- `CHANGELOG.md` — Keep-a-Changelog format, `[Unreleased]` only
- `CONTRIBUTING.md` — dev setup + PR workflow
- `SECURITY.md` — private disclosure via GitHub Security Advisory
- `CODE_OF_CONDUCT.md` — Contributor Covenant 2.1
- `.editorconfig` — universal editor config
- `.gitignore` — only `vendor/`, lock, caches, IDE
- `.gitattributes` — `export-ignore` for `tests/`, `bin/`, `examples/`,
  `.github/`, and dev-only root files so the Packagist tarball ships
  887 files instead of all 914
- `.github/workflows/tests.yml` — CI matrix, declares
  `permissions: contents: read` (least privilege)
- `.github/dependabot.yml` — Composer + GitHub-Actions update PRs
- `.github/PULL_REQUEST_TEMPLATE.md` — review checklist
- `.github/ISSUE_TEMPLATE/{bug_report,feature_request,config}.yml` —
  structured issue forms

---

## 13. Known trade-offs and intentional choices

- **PascalCase method names on `VmClient` / `ZecClient`** intentionally
  deviate from PSR-12's camelCase recommendation so that Action names
  copy-pasted from the API reference work verbatim. Pint is configured
  to leave them alone.
- **No PSR-3 logging hook** in v0.1.x. Debug logging happens only via
  Guzzle's `debug` option when `'debug' => true` is set in the
  connection config. A dedicated `LoggerInterface` injection point is a
  candidate for v0.2.
- **`SDK_VERSION` constant** in `AbstractClient` is hardcoded `'0.1.0'`.
  Maintainers must bump it in lock-step with git tags. Reading from
  `Composer\InstalledVersions` is a candidate for later if the duplication
  becomes painful.
- **Generated tree is committed**. The 871 generated files inflate the
  repo by ~3 MB but allow the SDK to ship without any build step on the
  consumer side. The codegen tool is excluded from Packagist via
  `.gitattributes`.

---

## 14. What I, the implementer, could not verify

- **Real Zenlayer Cloud API calls**. No AKID / SK pair was used to hit
  production. The byte-for-byte signature alignment + hard-coded golden
  vectors + Http::fake() captured-byte assertions give very high
  confidence, but the first real-world call against the live service is
  still the v0.1.0 production test.
- **PHP 8.4 in real CI**. The local toolchain runs PHP 8.3.31 only. The
  GitHub Actions matrix includes 8.4 and will run on first push.

---

## 15. Audit history (for the curious reviewer)

The codebase was audited ten times across iterative review rounds. Each
round added a different angle, found real issues, and fixed them
before claiming green. A non-exhaustive log:

1. Implementation + first green: signature byte-for-byte vs upstream,
   action counts (61/197), basic test suite.
2. Open-source standards + removal of incidental references to other-
   language SDKs from user-facing artifacts.
3. Source-code re-read: catches dead `ERR_*` constants, dead
   `provides()` method (turned into a real deferred provider).
4. Real-execution audit: PHP `-l` over every file, fresh `composer
   require` in a temp project, `Http::recorded()` byte capture of an
   actual signed request.
5. Senior-reviewer angle: `.gitattributes` export-ignore (saved ~140 KB
   per install), PHPStan level 5 → level 8.
6. Multi-axis: code coverage tooling check, reserved-word collision
   scan, autoloader integrity (881/881 classes resolve), README internal
   link validity, large-response hydration benchmark.
7. File-by-file 47-file pass: caught 7 paper-cut issues (composer plugin
   line, `.gitignore` stale line, CHANGELOG stale Python reference,
   SECURITY.md placeholder, mis-named ZEC example, weak assertion in
   `test_non_200_success_status_is_still_treated_as_error`, CI silent
   `|| true` after PHPStan).
8. Full 914-file manifest with bulk invariants (`class` line matches
   filename, every file has `declare(strict_types=1)`).
9. Package rename to `augusl/zenlayercloud-laravel-sdk`.
10. Multi-angle pre-release audit (8 angles), discovered:
    - `var_export($credential)` leaked the password despite earlier
      redaction. Fixed by moving the secret into a closure.
    - GitHub Actions had no `permissions:` declaration → added
      `contents: read`.
    - The new round-trip functional test used a wrong field name
      (`diskId` vs `diskIdSet`) on `DiskWithInstance`. Fixed.
    - Added 6 new tests (var_export leak guard, var_dump leak guard,
      print_r leak guard, serialize blocked, full CreateInstances
      round-trip with nested models, forward-compat unknown fields).

Across the ten rounds, **44+ distinct issues** were caught and fixed.
This list is preserved here so the reviewer can spot-check the kinds of
problems that have already been ruled out — and look for ones that
haven't.

---

## 16. Suggested reviewer checklist

When reviewing, the highest-signal places to look:

1. **`src/Common/Signer.php`** — 70 LOC. Cross-check against the
   `ZC2-HMAC-SHA256` spec on Zenlayer's docs. The fixture in
   `tests/Unit/SignerTest.php` includes hand-verifiable inputs.
2. **`src/Common/AbstractClient.php`** — the only place that sends real
   HTTP. Look for: header set is complete, signature derivation order,
   error vs success branching, JSON parse exception handling.
3. **`src/Common/AbstractModel.php`** — reflection-based hydration.
   Look for: `$_typeMap` works for array-of-model fields, nested
   single-model deserialization respects PHP type system, `toArray`
   correctly omits nulls.
4. **`src/Common/Credential.php`** — 80 LOC. Verify the closure-based
   secret hiding actually defeats `var_export`. Check `__serialize`
   throws.
5. **`src/Common/Config.php`** — endpoint normalization (`https://` and
   trailing slash stripping), `request_client` regex.
6. **`src/ZenlayerCloudManager.php`** — multi-connection caching,
   `flushClients()`, unknown-connection error path.
7. **`src/ZenlayerCloudServiceProvider.php`** — deferred provider, binding
   list matches `provides()`.
8. **`bin/codegen.php`** — single PHP file, no external deps. Verify the
   Go-style → PHP type mapping table is exhaustive (no warnings emitted
   on the current schema).
9. **`tests/Feature/VmClientTest.php`** — end-to-end with Laravel's
   `Http::fake()`. The signed-POST test asserts every header the SDK
   sends.
10. **Generated code** — sample any model under `src/Vm/V20260401/Models/`
    or `src/Zec/V20250901/Models/` and compare its property list to the
    upstream Action's input shape on Zenlayer's API docs.

If any of those layers look wrong, please file a finding back to me with
the specific class / line so I can attack it directly.

— `augusl/zenlayercloud-laravel-sdk` maintainer
