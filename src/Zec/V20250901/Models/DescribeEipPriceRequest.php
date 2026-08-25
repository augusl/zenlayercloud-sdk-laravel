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
     *
     * @deprecated
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
     * FlowPackage 弹性公网IP的流量包大小。
     * 单位为TB。
     * 值要求为0或0.1的倍数。
     * 当网络计费方式为流量计费(`ByTrafficPackage`)时需要指定。
     */
    public ?float $flowPackage = null;

    /**
     * CidrId 指定CIDR ID，使用CIDR内分配弹性IP。
     * 该字段和`eipV4Type`不能同时指定。
     */
    public ?string $cidrId = null;

    /**
     * ClusterId 共享带宽包ID。
     * 当指定`peerRegionId`且网络计费方式为共享带宽包计费(`BandwidthCluster`)时需要指定。
     */
    public ?string $clusterId = null;

    /**
     * PeerRegionId 远端的节点ID。
     */
    public ?string $peerRegionId = null;
}
