# Upstream compatibility

This is an unofficial SDK. Generated API classes are derived from Zenlayer's
official language SDKs and checked against the public API reference; they are
not inferred from examples or handwritten independently.

## Current snapshot

Last contract audit: **2026-08-27**.

| Source | Audited revision |
|--------|------------------|
| [Official Go SDK](https://github.com/zenlayer/zenlayercloud-sdk-go/tree/v0.2.52) | `v0.2.52` / `a9ce8126ea685f57abb1c66d8f56674dd8ea338e` |
| [Official Python SDK](https://github.com/zenlayer/zenlayercloud-sdk-python/tree/2.0.73) | `2.0.73` / `c0f22181fb03802dcd98fbd1036a4245ce5546a5` |
| [VM API reference](https://docs.console.zenlayer.com/api-reference/compute/vm) | API `2026-04-01` |
| [IPT API reference](https://docs.console.zenlayer.com/api-reference/cn/networking/ipt) | API `2024-09-01` |
| [ZEC API reference](https://docs.console.zenlayer.com/api-reference/compute/zec) | API `2025-09-01` |

The Go and Python SDKs agree on the VM/IPT/ZEC Action sets and the corresponding
request/payload fields (their response-wrapper class layouts differ by
language):

| Service | Actions | Models |
|---------|--------:|-------:|
| VM | 62 | 213 |
| IPT | 12 | 59 |
| ZEC | 225 | 761 |
| **Total** | **299** | **1,033** |

An independent Go-to-PHP type audit checked every generated property and both
runtime array maps: VM 213 models / 625 fields, IPT 59 models / 256 fields, and
ZEC 761 models / 2,419 fields, with zero type or mapping differences. The IPT
total represents 55 declared Go structures plus four anonymous response
structures promoted to named PHP models. The ZEC total includes the one
documented `CreateEipsRequest.instanceId` override described below; the Go
schema itself contains 2,418 ZEC JSON fields.

A separate second-pass audit independently compared the public Action pages
and their linked data-type tables with the Go schema: all 62 VM pages / 501
checked field entries and all 220 linked ZEC pages / 1,945 checked field entries
matched after applying the documented `CreateEipsRequest.instanceId` override.
All 12 IPT pages / 112 direct request-response fields and all 23 structured
data-type tables / 120 fields also matched, including scalar versus nested
model and scalar/model-list wire types.
Another structural comparison checked Python-to-Go field and nested-model
relationships (VM 501, IPT 232, and ZEC 1,968 field relationships), also with
zero differences. IPT additionally checked all 42 nested object/list targets.
These checks are independent of the Go-to-PHP generator audit.

## Known upstream/documentation differences

At the audited revisions, the ZEC documentation index links 220 Actions while
both official SDKs expose 225. The following five SDK Actions are therefore
included here even though they are not linked from the public index:

- `CreateSubnets`
- `DeleteSubnets`
- `DescribeZoneAcceleratorConfigInfos`
- `ModifyEipBlockThreshold`
- `ReplaceNetworkInterfacePrimaryIpv4`

The [CreateEips reference](https://docs.console.zenlayer.com/api-reference/compute/zec/elastic-ip/createeips)
documents `instanceId`, explains its precedence over `instanceIds`, and uses it
in request examples. Both official language SDK request models currently omit
that field. This package includes `CreateEipsRequest::$instanceId` through an
explicit override in `bin/codegen.php`; it is automatically skipped when the
official Go schema adds the field.

The public ZEC pages and both official SDKs still retain the following legacy
request fields and mark them deprecated. They are not contract discrepancies;
this package keeps them for wire/backward compatibility and carries the marker
into PHP's `@deprecated` annotation:

| Action | Legacy field(s) |
|--------|-----------------|
| `ChangeEipInternetChargeType` | `bandwidthCap` |
| `CreateCidr` | `eipV4Type` |
| `CreateEips` | `eipV4Type`, `primaryIsp` |
| `CreateZecInstances` | `eipV4Type` |
| `DescribeCidrPrice` | `eipV4Type` |
| `DescribeEipInternetChargeTypes` | `eipV4Type` |
| `DescribeEipPrice` | `eipV4Type` |
| `DescribeEipRemoteRegions` | `eipV4Type` |
| `InquiryPriceCreateInstance` | `eipV4Type` |
| `ModifyEipBandwidth` | `commitBandwidth` |
| `UnassignNetworkInterfaceIpv4` | `ipAddress` |

## Regeneration and review

Clone the official Go SDK at the intended tag, then run:

```bash
composer codegen -- /path/to/zenlayercloud-sdk-go/zenlayercloud
composer lint:fix
composer analyse
composer test
```

The generator validates every service before replacing output, refuses unknown
Go types instead of silently emitting `mixed`, and produces deterministic
output. Any upstream upgrade should update the snapshot above, review every
generated diff, and re-check the same tag against the Python SDK and public
documentation.
