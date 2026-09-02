# Upstream compatibility

This is an unofficial SDK. Generated API classes are derived from Zenlayer's
official language SDKs and checked against the public API reference; they are
not inferred from examples or handwritten independently.

## Current snapshot

Last contract audit: **2026-09-02**.

| Source | Audited revision |
|--------|------------------|
| [Official Go SDK](https://github.com/zenlayer/zenlayercloud-sdk-go/tree/v0.2.53) | `v0.2.53` / `547b16fcf5e5b79ce91eab9cc52546a143c8d477` |
| [Official Python SDK](https://github.com/zenlayer/zenlayercloud-sdk-python/tree/2.0.74) | `2.0.74` / `c6d510f5165801cc12948fd06e5629e3e97ddf34` |
| [VM API reference](https://docs.console.zenlayer.com/api-reference/compute/vm) | API `2026-04-01` |
| [IPT API reference](https://docs.console.zenlayer.com/api-reference/cn/networking/ipt) | API `2024-09-01` |
| [ZEC API reference](https://docs.console.zenlayer.com/api-reference/compute/zec) | API `2025-09-01` |

The same upstream release also changes ZLB, ZOS, ZRM, and ZSP. Those services
remain intentionally excluded because this package's declared scope is only
VM, IPT, and ZEC; omitting them here is not a partial sync of a supported
service.

The Go and Python SDKs agree on the VM/IPT/ZEC Action sets and the corresponding
request/payload fields (their response-wrapper class layouts differ by
language):

| Service | Actions | Models |
|---------|--------:|-------:|
| VM | 62 | 213 |
| IPT | 12 | 59 |
| ZEC | 226 | 771 |
| **Total** | **300** | **1,043** |

An independent parser/reflection audit checked every generated property and
both runtime array maps: VM 213 models / 625 fields, IPT 59 models / 256 fields,
and ZEC 771 models / 2,462 fields, with zero Action, field, type, route, or array
mapping differences. That is 300 Actions, 1,043 models, and 3,343 typed fields
in total. A separate comparison with the Python SDK checked its 743 semantic
models after accounting for Python's flattened response wrappers, also with
zero field or nested-model differences. The official ZEC schemas now include
`CreateEipsRequest.instanceId` natively.

The current public Action indexes expose all 62 VM Actions, all 12 IPT Actions,
and 225 of the 226 ZEC Actions. A page-by-page audit checked all 299 published
pages: 1,808 direct request/response fields plus 894 fields in 136 linked data
structures. Every published field and wire type agrees with the SDKs; the
SDK-only additions listed below are the complete set of missing documentation
entries. An exact Action-set comparison leaves only `DescribeRegions` absent
from the ZEC index.

## Known upstream/documentation differences

### Official SDKs ahead of the public ZEC reference

Both official language SDKs expose `DescribeRegions` with `regionIds` filtering
and typed `RegionItem` results, but the [ZEC index](https://docs.console.zenlayer.com/api-reference/compute/zec)
and its Location section currently expose only `DescribeZones`.

The official SDKs also add response fields that are not yet shown on their
public Action pages:

- `previousPrices` on `InquiryPriceModifyInstanceType`,
  `InquiryPriceResizeDisk`, `InquiryPriceChangeIpv6InternetChargeType`,
  `InquiryPriceModifyIpv6Bandwidth`, `InquiryPriceModifyEipBandwidth`,
  `InquiryPriceModifyEipFlowPackage`,
  `InquiryPriceChangeEipInternetChargeType`,
  `InquiryPriceModifyCrossRegionBandwidth`,
  `InquiryPriceModifyUnmanagedEgressIpBandwidth`, and
  `InquiryPriceChangeUnmanagedEgressIpInternetChargeType`;
- `acceleratorPrice` on `InquiryPriceResizeDisk`;
- `loseInMaxValue`, `loseInMinValue`, `loseInTotalValue`,
  `loseOutMaxValue`, `loseOutMinValue`, and `loseOutTotalValue` on
  `DescribeCrossRegionBandwidthMonitorData`, plus `loseInValue` and
  `loseOutValue` on its metric items.

The SDK prose additionally documents Base64/64 KB limits for ZEC instance
`userData` and expanded multi-CIDR VPC rules that are not yet present on the
corresponding public pages. These are usage constraints, not PHP type changes.

### Public documentation details preserved locally

The [StopInstances reference](https://docs.console.zenlayer.com/api-reference/compute/vm/virtual-machine-instance/stopinstances)
still documents `forceShutdown` as defaulting to `true`. Go `v0.2.53` removed
that sentence without changing the field or API version, so `bin/codegen.php`
preserves the documented default in the generated PHPDoc.

### Resolved differences

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
