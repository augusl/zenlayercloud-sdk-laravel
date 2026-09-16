# Upstream compatibility

This is an unofficial SDK. Generated API classes are derived from Zenlayer's
official language SDKs and checked against the public API reference; they are
not inferred from examples or handwritten independently.

## Current snapshot

Last contract audit: **2026-09-16**.

| Source | Audited revision |
|--------|------------------|
| [Official Go SDK](https://github.com/zenlayer/zenlayercloud-sdk-go/tree/v0.2.54) | `v0.2.54` / `4a534faeaaff891d848c10e5af518ac9e25a259e` |
| [Official Python SDK](https://github.com/zenlayer/zenlayercloud-sdk-python/tree/2.0.75) | `2.0.75` / `3cd8d44ae1dec89c200226f5bd248a46ba0ff380` |
| [VM API reference](https://docs.console.zenlayer.com/api-reference/compute/vm) | API `2026-04-01` |
| [IPT API reference](https://docs.console.zenlayer.com/api-reference/cn/networking/ipt) | API `2024-09-01` |
| [ZEC API reference](https://docs.console.zenlayer.com/api-reference/compute/zec) | API `2025-09-01` |

Both audited tags are still the latest releases and match their repositories'
default `main` branches as of the audit date.

The same upstream release also changes SDN and ZLB. Those services
remain intentionally excluded because this package's declared scope is only
VM, IPT, and ZEC; omitting them here is not a partial sync of a supported
service.

The Go and Python SDKs agree on the VM/IPT/ZEC Action sets and the corresponding
request/payload fields (their response-wrapper class layouts differ by
language):

| Service | Actions | Models |
|---------|--------:|-------:|
| VM | 62 | 213 |
| IPT | 12 | 60 |
| ZEC | 234 | 798 |
| **Total** | **308** | **1,071** |

An independent parser/reflection audit checked every generated property and
both runtime array maps: VM 213 models / 625 fields, IPT 60 models / 262 fields,
and ZEC 798 models / 2,568 fields, with zero Action, field, type, route, or array
mapping differences. That is 308 Actions, 1,071 models, and 3,455 typed fields
in total. A separate comparison with the Python SDK checked its 763 semantic
models after accounting for Python's flattened response wrappers, also with
zero field or nested-model differences. Full-field recursive JSON round trips
and null omission were also verified for all 1,071 PHP models, including
preservation of 4-byte ASN values on the required 64-bit PHP platform.

The current public Action indexes expose all 62 VM Actions, all 12 IPT Actions,
and all 234 ZEC Actions. A page-by-page audit checked all 308 published pages:
1,887 direct request/response fields plus 952 fields in 147 linked data
structures. All 2,839 business fields agree with the official SDKs; no Action,
field, or wire-type discrepancy remains in those tables.

## Changes in this snapshot

- IPT adds `bgpTier` for price inquiries, `RiptBgpConfig.tier` for creation,
  and available tier/peer ASN metadata through `RiptPeerAsn`. Unset tier fields
  are omitted so the server's existing `PREMIUM` default remains effective.
- ZEC adds six BYO ASN Actions and two public IPv6 Actions
  (`DescribeIpv6Addresses` and `DeleteIpv6Addresses`), plus instance
  type/series filters and `InquiryPricePublicIpv6.amount`.
- `DeleteIpv6Addresses` can succeed at the API level while individual items
  fail. Callers must inspect `failedIpv6Addresses`; the SDK does not turn these
  results into transport exceptions or retry the successful batch request.
- VM is unchanged. No existing Action/model/field was removed or retyped,
  and the three service API versions are unchanged. The official common
  request implementation changed only its SDK version string, so no common
  runtime or dependency changes are required here.

## Known upstream/documentation differences

### VPC example prose lags behind the parameter table

The [ModifyVpcAttribute reference](https://docs.console.zenlayer.com/api-reference/compute/zec/vpc-network/modifyvpcattribute)
parameter table and Go SDK agree that `cidrBlock` is a full replacement and
must still contain every existing subnet; unused ranges can be narrowed or
removed. One example's explanatory paragraph still says that every original
VPC range must be covered whenever subnets exist. Generated PHPDoc follows
the parameter table and SDK. The PHP SDK does not add a conflicting local
business-rule validator.

### Public documentation details preserved locally

The [StopInstances reference](https://docs.console.zenlayer.com/api-reference/compute/vm/virtual-machine-instance/stopinstances)
still documents `forceShutdown` as defaulting to `true`. Go `v0.2.53` removed
that sentence without changing the field or API version, so `bin/codegen.php`
preserves the documented default in the generated PHPDoc.

### Resolved differences

`DescribeRegions` is now present in the public index. The previously missing
`previousPrices`, accelerator pricing, and cross-region packet-loss fields
are also documented. The public pages now describe the Base64-encoded
`userData` limit as strictly less than 64 KiB after decoding, and document
the multi-CIDR VPC quota and replacement semantics.

The five ZEC Actions previously missing from the public index
(`CreateSubnets`, `DeleteSubnets`, `DescribeZoneAcceleratorConfigInfos`,
`ModifyEipBlockThreshold`, and `ReplaceNetworkInterfacePrimaryIpv4`) now have
linked public pages.

The [CreateEips reference](https://docs.console.zenlayer.com/api-reference/compute/zec/elastic-ip/createeips)
and both current official SDKs now include `instanceId`, its precedence over
`instanceIds`, and the related examples, so no local field override remains.

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
