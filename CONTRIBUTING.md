# Contributing

Thanks for considering a contribution! This document covers the dev workflow
for the Zenlayer Cloud Laravel SDK.

## Code of conduct

By participating you agree to abide by our [Code of Conduct](CODE_OF_CONDUCT.md).

## Reporting bugs and requesting features

Please open a GitHub issue with the relevant template. Useful information:

- Laravel and PHP version.
- A minimal reproduction (the test suite is the easiest way to demonstrate
  an issue).
- The Zenlayer Cloud Action involved (e.g. `DescribeInstances`).

Do **not** file public issues for security vulnerabilities — follow the
process in [SECURITY.md](SECURITY.md).

## Development setup

```bash
git clone https://github.com/augusl/zenlayercloud-sdk-laravel.git
cd zenlayercloud-sdk-laravel
composer install
```

Required tooling:

- 64-bit PHP `^8.2`
- Composer 2.x

### Useful commands

```bash
composer test       # PHPUnit suite (Orchestra Testbench + Http::fake())
composer lint       # Pint, check-only
composer lint:fix   # Pint, fix in place
composer analyse    # PHPStan
composer audit      # runtime dependency advisories
```

### Testing against older Laravel versions locally

Laravel 11 is past its security-fix window, so Composer ≥ 2.9 blocks
resolving it while advisories remain open. To run the suite against the
Laravel 11 leg locally:

```bash
composer config policy.advisories.block false   # temporary, do not commit
composer update --with="illuminate/support:^11.0" \
                --with="illuminate/http:^11.0" \
                --with="illuminate/contracts:^11.0" \
                --with="orchestra/testbench:^9.0"
composer test
composer config --unset policy                  # restore the default
```

## Writing tests

- Unit tests live under `tests/Unit/`. Pure PHP, no Laravel boot.
- Feature tests live under `tests/Feature/`. They extend `Tests\TestCase`,
  which boots Orchestra Testbench and pre-configures two named connections
  (`default`, `staging`).
- Mock outgoing HTTP with `Illuminate\Support\Facades\Http::fake()`. Avoid
  any test that talks to real Zenlayer Cloud — they are flaky, slow, and
  cost money.

## Regenerating the typed client + model classes

The `src/Vm/V20260401/`, `src/Ipt/V20240901/`, and `src/Zec/V20250901/` trees
are regenerated from an upstream Zenlayer Cloud schema source by
`bin/codegen.php`. The generated output is committed to git — consumers never
need to run the generator.

```bash
ZENLAYER_GO_TAG=v0.2.52
git clone --branch "$ZENLAYER_GO_TAG" https://github.com/zenlayer/zenlayercloud-sdk-go.git
composer codegen -- /path/to/zenlayercloud-sdk-go/zenlayercloud
composer lint:fix         # Pint may want to format the new files
composer analyse
composer test
```

The generator is idempotent: re-running it with the same input produces
byte-identical output. If you see a diff with no upstream change, that is a
bug — please file an issue.

For an upstream version bump, compare the same Action/model contract against
the official Python SDK and public VM/IPT/ZEC documentation, then update
[`UPSTREAM.md`](UPSTREAM.md) with the exact tags and commits. Review the
documented compatibility override there before adding any new override.

## Coding standards

- Strict types (`declare(strict_types=1);`) on every PHP file.
- Pint with the default Laravel preset (`pint.json` lives in repo root if
  customised). Run `composer lint:fix` before pushing.
- Public Action method names (on `VmClient`, `IptClient`, and `ZecClient`)
  intentionally use PascalCase to match the upstream Action names. Pint does
  not enforce camelCase on those.
- No comments that simply restate what the next line of code does. Reserve
  comments for non-obvious *why*.

## Submitting a pull request

1. Fork the repo and create a feature branch.
2. Keep commits focused; squash WIP commits before opening the PR.
3. Ensure `composer test`, `composer lint`, and `composer analyse` all pass.
4. Add or update tests covering the change.
5. Update `CHANGELOG.md` under the `[Unreleased]` heading if user-visible.
6. Open the PR against `main` with a clear description, including the
   motivation and any tradeoffs.

CI will run every supported combination in the PHP 8.2 / 8.3 / 8.4 / 8.5
and Laravel 11 / 12 / 13 matrix (Laravel 13 on PHP 8.2 is excluded because
that framework version requires PHP 8.3 or newer).
Reviewers may ask for changes — please keep the discussion friendly and
focused on the code.

## License

By contributing you agree that your contribution is licensed under the
[Apache License 2.0](LICENSE).
