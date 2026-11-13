<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * EipInfo 描述公网弹性IP的基本信息，包括IPv4地址，IP绑定的关系。
 */
class EipInfo extends AbstractModel
{
    /**
     * EipId EIP的唯一ID。
     */
    public ?string $eipId = null;

    /**
     * Name EIP的名称。
     */
    public ?string $name = null;

    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * PeerRegionId 对端节点ID。
     * 仅当IP为Remote IP时该字段有效。
     */
    public ?string $peerRegionId = null;

    /**
     * IsDefault 是否是默认类型。
     */
    public ?bool $isDefault = null;

    /**
     * IsCustomized 是否为自定义地址。
     * true 表示该EIP的公网IP是从默认EIP池中手动指定的，计入自定义地址EIP配额；来自CIDR的EIP恒为false。
     */
    public ?bool $isCustomized = null;

    /**
     * Status EIP的状态。
     */
    public ?string $status = null;

    /**
     * PublicIpAddresses 公网IP地址。
     *
     * @var list<string>|null
     */
    public ?array $publicIpAddresses = null;

    /**
     * PrivateIpAddress EIP绑定的内网IP地址。
     */
    public ?string $privateIpAddress = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type EIP网络类型。
     * 表示该CIDR支持的公网IP线路类型。
     * 已废弃，请参考`networkLineType`。
     *
     * @deprecated
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType EIP网络类型。
     * 表示该CIDR支持的公网IP线路类型。
     */
    public ?string $networkLineType = null;

    /**
     * InternetChargeType EIP的网络计费方式。
     */
    public ?string $internetChargeType = null;

    /**
     * CidrId EIP来自的CIDR地址段ID。
     */
    public ?string $cidrId = null;

    /**
     * Deprecated: NicId 已废弃，请不要使用。
     * NicId EIP关联的网卡ID。
     * 该字段已废弃，请使用`associatedId`字段。
     *
     * @deprecated
     */
    public ?string $nicId = null;

    /**
     * AssociatedId EIP绑定的资源ID。
     * 可能为负载均衡ID、网卡ID或者NAT网关ID。
     */
    public ?string $associatedId = null;

    /**
     * AssociatedType EIP资源类型。
     * 可能为负载均衡ID、网卡ID或者NAT网关ID。
     */
    public ?string $associatedType = null;

    /**
     * InstanceId EIP绑定的实例ID。
     * 当且仅当`associatedType`字段为`NIC`时可能有值。
     */
    public ?string $instanceId = null;

    /**
     * BindType EIP绑定类型。
     */
    public ?string $bindType = null;

    /**
     * FlowPackage EIP流量包大小。
     * 仅当网络计费方式为流量计费时可取到值。
     * 该字段可能为null。
     */
    public ?float $flowPackage = null;

    /**
     * FlowPackages EIP多方向流量包列表。
     * 仅当网络计费方式为流量计费时可取到值。
     * 该字段可能为null。
     *
     * @var list<FlowPackageResponseItem>|null
     */
    public ?array $flowPackages = null;

    /**
     * Bandwidth EIP的带宽限速。
     * 单位为Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;

    /**
     * EipGeoRefs EIP的地理位置信息。
     *
     * @var list<EipGeoInfo>|null
     */
    public ?array $eipGeoRefs = null;

    /**
     * BlockInfoList EIP的封堵阈值。
     *
     * @var list<BlockInfo>|null
     */
    public ?array $blockInfoList = null;

    /**
     * CreateTime EIP的创建时间。
     */
    public ?string $createTime = null;

    /**
     * ExpiredTime EIP的到期时间。
     * 该字段可能为null。
     */
    public ?string $expiredTime = null;

    /**
     * ResourceGroupId EIP关联的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName EIP关联的资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * BandwidthCluster EIP关联的带宽组ID。
     */
    public ?BandwidthClusterInfo $bandwidthCluster = null;

    /**
     * Tags EIP关联的标签。
     */
    public ?Tags $tags = null;

    /**
     * OperationInfo EIP的带宽、流量包操作状态。
     */
    public ?OperationInfo $operationInfo = null;

    /**
     * PrefixLength 掩码长度。
     * 32表示单IP，25–31表示IP块。
     */
    public ?int $prefixLength = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'flowPackages' => FlowPackageResponseItem::class,
        'eipGeoRefs' => EipGeoInfo::class,
        'blockInfoList' => BlockInfo::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'publicIpAddresses' => 'string',
    ];
}
