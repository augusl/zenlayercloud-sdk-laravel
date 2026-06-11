<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * EipInfo 描述公网弹性IP的基本信息，包括IPv4地址，IP绑定的关系。
 */
class EipInfo extends AbstractModel
{
    /**
     * EipId EIP 的唯一 ID。
     */
    public ?string $eipId = null;

    /**
     * Name EIP 的名称。
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
     * Status EIP 的状态。
     */
    public ?string $status = null;

    /**
     * PublicIpAddresses 公网IP地址。
     */
    public ?array $publicIpAddresses = null;

    /**
     * PrivateIpAddress EIP 绑定的内网IP地址。
     */
    public ?string $privateIpAddress = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type EIP网络类型。
     * 表示该CIDR支持的公网IP线路类型。
     * 已废弃，请参考`networkLineType`。
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType EIP网络类型。
     * 表示该CIDR支持的公网IP线路类型。
     */
    public ?string $networkLineType = null;

    /**
     * InternetChargeType EIP 的网络计费方式。
     */
    public ?string $internetChargeType = null;

    /**
     * CidrId EIP 来自的CIDR地址段ID。
     */
    public ?string $cidrId = null;

    /**
     * Deprecated: NicId 已废弃，请不要使用。
     * NicId EIP 关联的网卡ID。
     * 该字段已废弃，请使用 `associatedId` 字段。
     */
    public ?string $nicId = null;

    /**
     * AssociatedId EIP 绑定的资源ID。
     * 可能为负载均衡ID、网卡ID或者NAT网关ID。
     */
    public ?string $associatedId = null;

    /**
     * AssociatedType EIP 资源类型。
     * 可能为负载均衡ID、网卡ID或者NAT网关ID。
     */
    public ?string $associatedType = null;

    /**
     * InstanceId EIP 绑定的实例ID。
     * 当且仅当`associatedType`字段为`NIC`时可能有值。
     */
    public ?string $instanceId = null;

    /**
     * BindType EIP 绑定类型。
     */
    public ?string $bindType = null;

    /**
     * FlowPackage EIP 流量包大小。
     * 仅当网络计费方式为流量计费时可取到值。
     * 该字段可能为null。
     */
    public ?float $flowPackage = null;

    /**
     * FlowPackages EIP 多方向流量包列表。
     * 仅当网络计费方式为流量计费时可取到值。
     * 该字段可能为null。
     *
     * @var FlowPackageResponseItem[]|null
     */
    public ?array $flowPackages = null;

    /**
     * Bandwidth EIP 的带宽限速。
     * 单位为Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;

    /**
     * EipGeoRefs EIP 的地理位置信息。
     *
     * @var EipGeoInfo[]|null
     */
    public ?array $eipGeoRefs = null;

    /**
     * BlockInfoList EIP的封堵阈值。
     *
     * @var BlockInfo[]|null
     */
    public ?array $blockInfoList = null;

    /**
     * CreateTime EIP 的创建时间。
     */
    public ?string $createTime = null;

    /**
     * ExpiredTime EIP 的到期时间。
     * 该字段可能为null。
     */
    public ?string $expiredTime = null;

    /**
     * ResourceGroupId EIP 关联的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName EIP 关联的资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * BandwidthCluster EIP 关联的带宽组ID。
     */
    public ?BandwidthClusterInfo $bandwidthCluster = null;

    /**
     * Tags EIP关联的标签。
     */
    public ?Tags $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'flowPackages' => FlowPackageResponseItem::class,
        'eipGeoRefs' => EipGeoInfo::class,
        'blockInfoList' => BlockInfo::class,
    ];
}
