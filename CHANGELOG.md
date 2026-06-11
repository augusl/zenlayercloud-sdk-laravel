# Changelog

All notable changes to this project are documented here. This project follows
[Keep a Changelog](https://keepachangelog.com/en/1.1.0/) and adheres to
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Initial release of the Zenlayer Cloud Laravel SDK.
- Common layer: `Credential`, `TokenCredential`, `CredentialInterface`,
  `Config`, `Signer` (ZC2-HMAC-SHA256), `AbstractClient`, `AbstractModel`,
  `HttpClientFactory`, `ZenlayerCloudSdkException`.
- Two authentication modes: AccessKey pair (HMAC signing) and personal
  access token (`Authorization: Bearer`), selectable per connection.
- Virtual Machine (VM) service client at API version `2026-04-01`,
  covering all 62 Actions with 213 typed Request/Response/nested model
  classes.
- Elastic Compute (ZEC) service client at API version `2025-09-01`,
  covering all 214 Actions with 717 typed model classes.
- Laravel integration: `ZenlayerCloudServiceProvider` (auto-discovered),
  `ZenlayerCloudManager` (multi-connection support with caching), and
  the `ZenlayerCloud` facade.
- Laravel 11.x, 12.x, and 13.x compatibility.
- Maintainer-only code generator (`bin/codegen.php`) producing the
  service clients and model classes from an upstream schema source.
- Open-source baseline: Apache-2.0 license, `CONTRIBUTING.md`,
  `SECURITY.md`, `CODE_OF_CONDUCT.md`, GitHub issue and pull-request
  templates, Dependabot configuration, and a CI test matrix across PHP
  8.2 / 8.3 / 8.4 and Laravel 11 / 12 / 13.
