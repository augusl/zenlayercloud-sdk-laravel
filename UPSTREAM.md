# Upstream compatibility

This is an unofficial SDK. Generated API classes are derived from Zenlayer's
official language SDKs and checked against the public API reference; they are
not inferred from examples or handwritten independently.

## Current snapshot

Last contract audit: **2026-11-13**.

| Source | Audited revision |
|--------|------------------|
| [Official Go SDK](https://github.com/zenlayer/zenlayercloud-sdk-go/tree/v0.2.59) | `v0.2.59` / `35a4deee088c70240348624f89662986f78151b2` |
| [Official Python SDK](https://github.com/zenlayer/zenlayercloud-sdk-python/tree/2.0.79) | `2.0.79` / `110906e65b4ab1051f3a261a239033f8bb67f3e6` |
| [VM API reference](https://docs.console.zenlayer.com/api-reference/legacy/vm/overview) | API `2026-04-01` |
| [Legacy IPT SDK contract](https://github.com/zenlayer/zenlayercloud-sdk-go/tree/v0.2.59/zenlayercloud/ipt20240901) | API `2024-09-01` (deprecated) |
| [ZEC API reference](https://docs.console.zenlayer.com/api-reference/zec/overview) | API `2025-09-01` |

Both audited tags are still the latest releases and match their repositories'
default `main` branches as of the audit date.

The same upstream updates also change BMC, SDN, User, and ZLB. Those services
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
| ZEC | 250 | 856 |
| **Total** | **324** | **1,130** |

An independent parser/reflection audit checked every generated property and
both runtime array maps: VM 213 models / 625 fields, IPT 61 models / 268 fields,
and ZEC 856 models / 2,753 fields, with zero Action, field, type, route, or array
mapping differences. That is 324 Actions, 1,130 models, and 3,646 typed fields
in total. A separate comparison with the Python SDK checked its 806 semantic
models after accounting for Python's flattened response wrappers, also with
zero field or nested-model differences. Full-field recursive JSON round trips
and null omission were also verified for all 1,130 PHP models, including
preservation of 4-byte ASN values on the required 64-bit PHP platform.

The official documentation keeps VM under `legacy/vm` and ZEC under `zec`.
Legacy IPT documentation links now redirect to SDN Internet, and the sitemap
no longer lists IPT Actions. The [sitemap](https://docs.console.zenlayer.com/api-reference/sitemap.md)
is used to locate Action and data-type pages; overview pages no longer contain
the complete Action indexes.

All 312 currently published VM/ZEC Action pages were checked, covering 1,885
direct request/response fields and 869 fields in 133 published data structures.
All 2,754 business fields agree with the official SDK schemas. The 12 legacy
IPT contracts were checked against both official SDKs, not against SDN pages
with different service routes and model names.

## Changes in this snapshot

- ZEC adds 11 Actions and 42 models: vNIC permission creation/listing/deletion;
  IPv6 CIDR pricing, purchase, attributes, netmasks, and regions;
  `DescribeByoipRegionAvailability`, `ModifyEipsBlockThreshold`, and
  `DescribeNatGatewayNewConnsMonitorData`.
- ZEC adds `DescribeEipsRequest.isCustomized`, `EipInfo.isCustomized`,
  `DescribeIpv6CidrsRequest.source`, `Ipv6CidrInfo.subnetMaskLength`,
  `DescribeSecurityGroupsRequest.isDefault`, and `RegionItem.location` /
  `wideRegionName` / `wideRegionTitle`.
- Both SDKs deprecate all 12 IPT Actions without removing their methods or
  changing their wire contracts. PHP preserves them and adds `@deprecated`.
- The official Go common client adds STS temporary credentials. PHP supports
  the same security-token header and signature extension. Python's common
  implementation is unchanged and does not yet expose this STS mode.
- VM's wire contract, all three API versions, existing AccessKey/Bearer
  authentication, retry policy, and package dependencies remain unchanged.
- Refreshed official PHPDoc includes block-EIP threshold support, customized
  address quotas, available-CIDR address counting, and disk-resize constraints.
  These rules remain API-enforced; no PHP business-rule validator is added.

## Upgrading applications and documented details

### IPT deprecation

Both official SDKs recommend the `sdn` Internet Actions instead of the 12
legacy IPT Actions. This is a deprecation notice, not evidence that the old
endpoints have been shut down: the methods and their models remain in both
audited SDKs. PHP keeps `/api/v2/ipt`, service `ipt`, API `2024-09-01`, and all
existing Action names. There is no implicit forwarding to `/api/v2/sdn`.

For example, the official replacement for `DescribeIPTransitDatacenters` is
`sdn:DescribeInternetDatacenters`; `ModifyIPTransitBandwidth` maps to
`sdn:ModifyInternetConfig` with `type=BANDWIDTH`. Applications must explicitly
migrate to an SDN-capable client if needed. Adding that product is outside
this package's current scope.

### STS temporary credentials

Go `v0.2.59` publishes `StsCredential` / `SecurityTokenCredential`. PHP follows
that optional-interface design with `StsCredential` and
`SecurityTokenCredentialInterface`, leaving the existing `CredentialInterface`
unchanged. For Laravel connections, set the temporary AccessKey pair and
`security_token` (`ZENLAYER_SECURITY_TOKEN`). Existing published configuration
files need that new entry added explicitly.

The client transmits the original `x-zc-security-token` value and includes it
in `SignedHeaders=content-type;host;x-zc-security-token`. Only the canonical
token value is trimmed and lower-cased, exactly as in the official Go signer.
Each physical retry reads and signs the credential snapshot again. Bearer
authentication takes precedence and sends no security-token header.

The application obtains and renews STS credentials externally. This package
does not add the User/AssumeRole product, a credential cache, or a background
refresh mechanism. Replace cached clients when replacing static credentials,
or supply a custom implementation of the optional credential interface.

STS golden vectors are cross-checked against the official Go signer with
only the test clock injected; the canonicalization and HMAC logic are kept
byte-identical to the audited upstream method.

### IPT model rename

The earlier Go `v0.2.55` / Python `2.0.76` update replaced `RemoteIptAvailableRoutingType` with
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
