# Upstream compatibility

This is an unofficial SDK. Generated API classes are derived from Zenlayer's
official language SDKs and checked against the public API reference; they are
not inferred from examples or handwritten independently.

## Current snapshot

Last contract audit: **2026-10-17**.

| Source | Audited revision |
|--------|------------------|
| [Official Go SDK](https://github.com/zenlayer/zenlayercloud-sdk-go/tree/v0.2.55) | `v0.2.55` / `f25b7ca8a0b5655f2362f20bd39d53fb4eb664e7` |
| [Official Python SDK](https://github.com/zenlayer/zenlayercloud-sdk-python/tree/2.0.76) | `2.0.76` / `091f85fcbdc29acb03dcf9e1dba393e74e81a4c3` |
| [VM API reference](https://docs.console.zenlayer.com/api-reference/legacy/vm/overview) | API `2026-04-01` |
| [IPT API reference](https://docs.console.zenlayer.com/api-reference/ipt/overview) | API `2024-09-01` |
| [ZEC API reference](https://docs.console.zenlayer.com/api-reference/zec/overview) | API `2025-09-01` |

Both audited tags are still the latest releases and match their repositories'
default `main` branches as of the audit date.

The same upstream release also changes BMC, SDN, and ZLB. Those services
remain intentionally excluded because this package's declared scope is only
VM, IPT, and ZEC; omitting them here is not a partial sync of a supported
service.

The Go and Python SDKs agree on the VM/IPT/ZEC Action sets and the corresponding
request/payload fields (their response-wrapper class layouts differ by
language):

| Service | Actions | Models |
|---------|--------:|-------:|
| VM | 62 | 213 |
| IPT | 12 | 61 |
| ZEC | 239 | 814 |
| **Total** | **313** | **1,088** |

An independent parser/reflection audit checked every generated property and
both runtime array maps: VM 213 models / 625 fields, IPT 61 models / 268 fields,
and ZEC 814 models / 2,623 fields, with zero Action, field, type, route, or array
mapping differences. That is 313 Actions, 1,088 models, and 3,516 typed fields
in total. A separate comparison with the Python SDK checked its 775 semantic
models after accounting for Python's flattened response wrappers, also with
zero field or nested-model differences. Full-field recursive JSON round trips
and null omission were also verified for all 1,088 PHP models, including
preservation of 4-byte ASN values on the required 64-bit PHP platform.

The official documentation has moved VM under `legacy/vm`, IPT under `ipt`,
and ZEC under `zec`. The [sitemap](https://docs.console.zenlayer.com/api-reference/sitemap.md)
is used to locate Action and data-type pages; overview pages no longer contain
the complete Action indexes.

All 313 supported Action pages were checked, covering 1,930 direct
request/response fields and 960 fields in 149 published data structures.
All 2,890 business fields agree with the official SDK schemas.

## Changes in this snapshot

- ZEC adds `AssociateVpcCidrBlock`, `UnassociateVpcCidrBlock`,
  `ModifyBorderGatewayInterconnectCidr`, `DescribeEipConcurrentConnsMonitorData`,
  and `DescribeEipNewConnsMonitorData`, together with 16 models.
- ZEC adds `CreateZecInstancesRequest.placementGroupId`,
  `CreateBorderGatewayRequest.interConnectCidr`,
  `ZbgInfo.interconnectCidrEditable`, and `VpcInfo.secondaryCidrBlocks`.
- IPT adds `DescribeIPTransitTrafficRequest.period` / `statistic`, plus
  `marketingInfo` on modification pricing and ordering, with `MarketingInfo`.
- VM's wire contract and all three service API versions are unchanged.
  Go's common client changed only its SDK version string; Python's common
  implementation is unchanged, so this update needs no transport or dependency
  changes.

## Upgrading applications and documented details

### IPT model rename

Both official SDKs replace `RemoteIptAvailableRoutingType` with
`IPTransitAvailableRoutingType`. PHP follows that rename: update imports,
construction, and type references to the new name. The JSON fields are
unchanged. The old model is removed; no compatibility alias is provided.

### ZEC VPC primary and secondary CIDRs

The [VPC data structure](https://docs.console.zenlayer.com/api-reference/zec/datastructure#vpcinfo)
returns the primary CIDR in `cidrBlock` and secondary CIDRs in
`secondaryCidrBlocks`. Applications that need every CIDR must read both.
The SDK preserves the fields separately, as the official SDKs do.

`CreateVpc` creates the primary CIDR. Use `AssociateVpcCidrBlock` to add a
secondary CIDR and `UnassociateVpcCidrBlock` to remove one.
[ModifyVpcAttribute](https://docs.console.zenlayer.com/api-reference/zec/vpc-network/modifyvpcattribute)
updates only the primary CIDR; it no longer accepts a comma-separated list
that overwrites all CIDRs. The primary-CIDR overlap and subnet constraints
are enforced by the API, not by a separate PHP business-rule validator.

The previous documentation inconsistency about full VPC CIDR replacement is
superseded by these explicit primary/secondary semantics.

### Public documentation details preserved locally

The [StopInstances reference](https://docs.console.zenlayer.com/api-reference/legacy/vm/virtual-machine-instance/stopinstances)
still documents `forceShutdown` as defaulting to `true`. Go `v0.2.53` removed
that sentence without changing the field or API version, so `bin/codegen.php`
preserves the documented default in the generated PHPDoc.

### Resolved differences

`DescribeRegions` is now present in the public index. The previously missing
`previousPrices`, accelerator pricing, and cross-region packet-loss fields
are also documented. The public pages now describe the Base64-encoded
`userData` limit as strictly less than 64 KiB after decoding, and document
the VPC primary/secondary CIDR semantics described above.

The five ZEC Actions previously missing from the public index
(`CreateSubnets`, `DeleteSubnets`, `DescribeZoneAcceleratorConfigInfos`,
`ModifyEipBlockThreshold`, and `ReplaceNetworkInterfacePrimaryIpv4`) now have
linked public pages.

The [CreateEips reference](https://docs.console.zenlayer.com/api-reference/zec/elastic-ip/createeips)
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
