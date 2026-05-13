<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeEipPriceRequest
 */
class DescribeEipPriceRequest extends AbstractModel
{
    /**
     * RegionId 创建EIP所在的节点ID。
     */
    public ?string $regionId = null;

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
     * Bandwidth 公网弹性IP的带宽限速。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * FlowPackage 公网IPv6的流量包大小。
     * 单位为TB。
     * 值要求为0或0.1的倍数。
     * 当子网的堆栈类型包括V6且为公网时，且网络计费方式是流量计费(`ByTrafficPackage`)需要指定。
     */
    public ?float $flowPackage = null;

    /**
     * CidrId 指定CIDR ID，使用CIDR内分配弹性IP。
     * 该字段和`eipV4Type`不能同时指定。
     */
    public ?string $cidrId = null;

    /**
     * ClusterId 公网IPv6所指定的共享带宽包ID。
     * 当子网的堆栈类型包括V6且为公网时，且网络计费方式是共享带宽包计费(`BandwidthCluster`)需要指定。
     */
    public ?string $clusterId = null;

    /**
     * PeerRegionId 远端的节点ID。
     */
    public ?string $peerRegionId = null;
}
