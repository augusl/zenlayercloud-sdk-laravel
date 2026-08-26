# Changelog

All notable changes to this project are documented here. This project follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and adheres to
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Complete IP Transit (IPT) `2024-09-01` support: 12 Actions, 59 typed models,
  facade/manager/container resolution, contract tests, and a read-only example.
- Eleven ZEC Actions present in the audited latest official SDKs but missing
  from the previous generated snapshot, bringing the surface to VM 62 / ZEC
  225 Actions and 974 model classes.
- Official-default retries for HTTP 429 / `REQUEST_LIMIT_EXCEEDED`, with
  configurable exponential backoff.
- Dedicated `SECURITY_CHALLENGE` (Cloudflare 403 challenge) and
  `REQUEST_BLOCKED` (HTTP 451) errors.
- Laravel `Arrayable` and PHP `JsonSerializable` support on every model.
- `UPSTREAM.md` with exact audited tags, commits, counts, and documented
  upstream discrepancies.
- Apache attribution in `NOTICE` for generated definitions derived from the
  official SDK schema.
- SPDX and modification notices on every generated API client/model file.

### Changed

- Regenerated VM, IPT, and ZEC from Go SDK `v0.2.52`, including updated fields,
  deprecation annotations, and complete scalar-array PHPDoc types.
- PHPStan level 8 now analyzes the complete generated tree, generator, and
  shipped examples instead of excluding generated source.
- Code generation now validates every service before writing, fails on unknown
  types instead of emitting `mixed`, verifies upstream service/version
  constants, takes an explicit source path, and applies the documented
  `CreateEipsRequest.instanceId` compatibility override.
- Debug mode now emits redacted request metadata and status through Laravel's
  PSR-3 logger instead of Guzzle wire dumps.
- Endpoint and numeric HTTP configuration now fail fast on invalid values.
- Named connections containing dots are resolved as literal connection names.
- CI compatibility coverage now includes PHP 8.5.
- Composer now requires a 64-bit PHP platform because the official schemas
  expose signed `int64` values that cannot be represented safely on 32-bit PHP.
- HMAC authentication is regenerated for every physical retry instead of
  reusing the original request timestamp after a long backoff.
- Rate-limit backoff now treats an integer `Retry-After` response header as the
  minimum wait required by the public API contract.
- Successful response envelopes are decoded once rather than separately as
  both objects and associative arrays.
- The manager receives its fixed HTTP/signing dependencies directly instead
  of retaining Laravel's container as a service locator.
- Generated Action request parameters are marked `SensitiveParameter` so
  passwords and initialization data cannot appear in exception traces.
- Removed redundant Composer stability settings and the unused direct Mockery
  development dependency; the PHPStan script now carries its required memory
  limit and is shared by local development and CI.
- CI now verifies one `--prefer-lowest` dependency installation in addition to
  the supported PHP/Laravel latest-version matrix.

### Fixed

- Corrected the VM creation examples to include every required API field,
  require an existing SSH key, and guard the billable call behind an explicit
  confirmation flag instead of generating and discarding an invalid password.
- Prevented debug mode from logging Authorization headers, credentials, and
  complete request/response bodies.
- Rejected malformed successful response envelopes and malformed nested model
  arrays as typed `JSON_PARSE_FAILED` errors.
- Enforced generated scalar-list and model-list element types during request
  serialization and response hydration.
- SDK version headers now use Composer's installed package version, with
  `0.1.1` as a fallback outside a normal Composer installation.
- Malformed error-envelope field types and invalid Laravel connection option
  types now fail cleanly with SDK exceptions instead of PHP conversion notices.
- Rejected non-object lists in nested model fields while preserving empty JSON
  objects decoded as empty arrays.
- Wrapped request serialization failures as `SDK_INVALID_REQUEST` before any
  HTTP request is sent.
- Preserved the raw API/SDK message separately from the formatted exception
  message through `errorMessage` and `getErrorMessage()`.
- Hardened transport-error redaction for overlapping values, encoded proxy
  credentials, and dynamically rotating custom credentials.

## [0.1.1] - 2026-06-11

### Added

- Bearer token authentication through `TokenCredential`.
- Full VM `2026-04-01` coverage (62 Actions / 213 models) and then-current ZEC
  `2025-09-01` coverage (214 Actions / 717 models).
- Hardened credential redaction, request-client validation, typed network
  errors, response-shape handling, and code-generation checks.

## [0.1.0] - 2026-05-13

### Added

- Initial Laravel package with VM and ZEC clients, HMAC authentication,
  generated typed models, multi-connection manager, facade, publishable
  configuration, tests, static analysis, and open-source project files.

[Unreleased]: https://github.com/augusl/zenlayercloud-sdk-laravel/compare/v0.1.1...HEAD
[0.1.1]: https://github.com/augusl/zenlayercloud-sdk-laravel/compare/v0.1.0...v0.1.1
[0.1.0]: https://github.com/augusl/zenlayercloud-sdk-laravel/releases/tag/v0.1.0
