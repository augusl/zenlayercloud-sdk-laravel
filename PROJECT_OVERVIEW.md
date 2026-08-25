# Project overview

`augusl/zenlayercloud-laravel-sdk` is an unofficial, community-maintained
Laravel package for Zenlayer Cloud OpenAPI. It provides Laravel-native client
resolution and transport while keeping the public Action and model contract
aligned with Zenlayer's official Go and Python SDKs.

## Supported surface

| Service | API version | Actions | Models |
|---------|-------------|--------:|-------:|
| Virtual Machine (VM) | `2026-04-01` | 62 | 213 |
| Elastic Compute (ZEC) | `2025-09-01` | 225 | 761 |
| **Total** | | **287** | **974** |

Only the latest VM and ZEC versions are shipped. Other Zenlayer services and
older API versions are deliberately out of scope. Exact upstream revisions and
known documentation differences are maintained in [UPSTREAM.md](UPSTREAM.md).

## Architecture

The package has three layers:

1. **Laravel integration** — `ZenlayerCloudServiceProvider`, facade, manager,
   published configuration, named connections, and container bindings.
2. **Generated service contract** — one VM client, one ZEC client, and typed
   Request/Response/nested model classes. PascalCase method names intentionally
   match Zenlayer Action names exactly.
3. **Common runtime** — credentials, HMAC signer, configuration validation,
   Laravel HTTP transport, serialization/hydration, retry policy, and typed
   exceptions.

A request follows one path:

```text
Facade / dependency injection
  -> named connection manager
  -> generated Action method
  -> AbstractClient::call()
  -> model JSON serialization
  -> Bearer token or ZC2-HMAC-SHA256 authentication
  -> Illuminate HTTP client
  -> retry/error-envelope handling
  -> typed response hydration
```

Generated files are committed so package consumers do not need Go, Python, or
a build step.

## Authentication and signing

Each connection uses one of two official authentication modes:

- `TokenCredential`: `Authorization: Bearer <token>`; no HMAC headers.
- `Credential`: AccessKey id/password with `ZC2-HMAC-SHA256`.

When both are configured, the token takes precedence. HMAC signing uses POST,
canonical URI `/`, an empty canonical query, signed headers
`content-type;host`, SHA-256 payload hashing, and HMAC-SHA-256. Golden-vector
tests protect byte-level compatibility with the official algorithm.

The endpoint is normalized before both URL creation and signing. It accepts
only `host[:port]` or `http(s)://host[:port]`; user info, paths, query strings,
fragments, control characters, and unsupported schemes are rejected.

## Models

Generated models extend `AbstractModel` and expose nullable typed public
properties. They implement Laravel `Arrayable` and `JsonSerializable`.

- Null fields are omitted from outbound JSON.
- Empty request/nested objects serialize as `{}`, not `[]`.
- Nested objects and lists of objects hydrate into their declared classes.
- Scalar and model lists validate list shape and every element type on both
  serialization and hydration.
- Unknown response fields are ignored for forward compatibility.
- Known-field type mismatches surface as `JSON_PARSE_FAILED` rather than raw
  PHP `TypeError` exceptions.
- A successful envelope is decoded once, preserving the distinction between
  JSON objects and lists while recursively hydrating typed nested models.

## Transport, retries, and errors

All traffic uses `Illuminate\Http\Client`, which allows applications to use
Laravel middleware and `Http::fake()`.

Retry policies remain separate:

- `retry=false` by default. When enabled, only connection exceptions are
  retried, with `retry_max` extra attempts. Because a connection can fail
  after a server receives the bytes, this opt-in policy can replay a
  non-idempotent write and should be enabled only when that risk is acceptable.
- HTTP 429 or error code `REQUEST_LIMIT_EXCEEDED` is retried three times by
  default with exponential delays (1s, 2s, 4s), matching the current official
  SDKs. An integer `Retry-After` value is honored as the minimum delay. The
  policy can be disabled independently.
- Other HTTP errors are never retried automatically.
- HMAC headers are regenerated for every physical network/rate-limit retry, so
  a long backoff never reuses an expired signing timestamp.

Every request-execution failure is a `ZenlayerCloudSdkException`. SDK-defined
codes include:

- `NETWORK_ERROR`
- `JSON_PARSE_FAILED`
- `CREDENTIAL_VALUE_MISSING`
- `CONFIG_INVALID`
- `SDK_INVALID_REQUEST`
- `REQUEST_LIMIT_EXCEEDED`
- `SECURITY_CHALLENGE` for Cloudflare's HTTP 403 challenge response
- `REQUEST_BLOCKED` for HTTP 451 security-policy responses

API error codes, raw error messages, and request ids are preserved. HTTP
responses without a valid API error envelope remain distinguishable from
network failures.

## Configuration and multi-account behavior

`config/zenlayercloud.php` follows Laravel's named-connection convention. Each
connection contains credentials plus endpoint, timeout, retry, TLS, proxy,
debug, and request-client options. Clients are cached per exact connection key;
dots in connection names are treated literally.

Connection option types are validated at the Laravel configuration boundary;
malformed arrays or scalars fail as `CONFIG_INVALID` instead of producing PHP
conversion warnings or silently changing values.

Debug mode is intentionally redacted. It sends method, URL, service, Action,
status to Laravel's PSR-3 logger and never logs Authorization, request bodies,
or response bodies. TLS verification remains enabled unless explicitly
overridden for a controlled environment.

## Generation and upstream parity

`bin/codegen.php` reads `models.go` and `client.go` for VM `20260401` and ZEC
`20250901` from the official Go SDK. Before writing it:

- parses and validates both services;
- rejects duplicate Actions/fields and missing request/response models;
- refuses unsupported Go types instead of silently degrading to `mixed`;
- emits scalar/model list PHPDoc used by PHPStan;
- carries upstream deprecations into PHP `@deprecated` tags;
- applies one documented compatibility override for
  `CreateEipsRequest.instanceId` while the official SDK schemas omit it.

The generated Action and field sets were also compared with the official
Python SDK and every linked public VM/ZEC Action page. See `UPSTREAM.md` for the
precise audit snapshot and the five official-SDK Actions not yet linked in the
ZEC documentation index.

## Quality and security controls

- PHPUnit exercises signing, both authentication modes, serialization,
  generated-surface integrity, retries, all special error paths, endpoint
  validation, redacted debug logging, Laravel publishing, and manager behavior.
- PHPStan level 8 analyzes the runtime, the complete generated tree, the code
  generator, and all shipped examples.
- Pint enforces the Laravel style preset and strict types.
- CI tests supported PHP/Laravel combinations plus one lowest-dependency
  resolution, and runs validation, static analysis, formatting, and dependency
  auditing.
- Credential secrets are closure-held, redacted from debugging, blocked from
  serialization, and marked with `SensitiveParameter` where passed. Transport
  failures are scrubbed using the exact credential used for that physical
  attempt, including rotating custom credentials and proxy user information.
- GitHub Actions uses read-only repository permissions.

## Intentional limitations

- This is not an official Zenlayer product and does not provide support for
  upstream service availability or account configuration.
- Automated tests do not call a live Zenlayer account because provisioning can
  mutate billable resources. Production authentication and account-specific
  permissions therefore require a consumer-owned smoke test.
- Request models do not perform Action-specific business validation; the API
  remains the authority for allowed values and cross-field rules.
