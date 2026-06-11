<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateEipsRequest
 */
class CreateEipsRequest extends AbstractModel
{
    /**
     * RegionId 创建EIP所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * Name EIP的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /**
     * InternetChargeType 公网弹性IP的网络计费方式。
     */
    public ?string $internetChargeType = null;

    /**
     * Amount 需要创建EIP的数量。
     */
    public ?int $amount = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type 公网弹性IP的线路类型。
     * 已废弃，请使用`networkLineType`。
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType 公网弹性IP的线路类型。
     */
    public ?string $networkLineType = null;

    /**
     * Deprecated: PrimaryIsp 已废弃，请不要使用。
     * PrimaryIsp 主公网IP的运营商。
     * 该字段仅作用于三线IP(`ThreeLine`)。
     */
    public ?string $primaryIsp = null;

    /**
     * Bandwidth 公网弹性IP的带宽限速。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * CidrId 指定CIDR ID，使用CIDR内分配弹性IP。
     * 该字段和`eipV4Type`不能同时指定。
     */
    public ?string $cidrId = null;

    /**
     * PublicIp 从CIDR里指定公网起始IP地址开始创建弹性IP。
     * 该字段仅在指定`cidrId`时生效。
     */
    public ?string $publicIp = null;

    /**
     * ResourceGroupId 弹性公网IP所放的资源组ID，如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * FlowPackage 公网IPv6的流量包大小。
     * 单位为TB。
     * 值要求为0或0.1的倍数。
     * 当子网的堆栈类型包括V6且为公网时，且网络计费方式是流量计费(`ByTrafficPackage`)需要指定。
     */
    public ?float $flowPackage = null;

    /**
     * ClusterId 公网IPv6所指定的共享带宽包ID。
     * 当子网的堆栈类型包括V6且为公网时，且网络计费方式是共享带宽包计费(`BandwidthCluster`)需要指定。
     */
    public ?string $clusterId = null;

    /**
     * PeerRegionId 远端的节点ID。
     */
    public ?string $peerRegionId = null;

    /**
     * MarketingOptions 市场营销的相关选项。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 弹性公网IP绑定的标签。
     * 注意：实例关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /**
     * InstanceIds 要绑定的实例ID集合。
     * 数量需要与`amount`字段一致。
     */
    public ?array $instanceIds = null;

    /**
     * BindType 绑定类型。
     * 当指定定`instanceIds`时生效。
     * 默认为普通NAT模式。
     */
    public ?string $bindType = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;
}
