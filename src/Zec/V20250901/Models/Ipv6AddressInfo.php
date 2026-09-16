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
 * Ipv6AddressInfo 公网IPv6的基本信息，包括IPv6地址段、计费配置与归属关系。
 */
class Ipv6AddressInfo extends AbstractModel
{
    /**
     * Ipv6Id 公网 IPv6 的唯一 ID。
     */
    public ?string $ipv6Id = null;

    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * Status 公网 IPv6 的状态。
     */
    public ?string $status = null;

    /**
     * Ipv6Cidr 公网 IPv6 的地址段。
     */
    public ?string $ipv6Cidr = null;

    /**
     * PrimaryIpv6Address 主 IPv6 地址。
     */
    public ?string $primaryIpv6Address = null;

    /**
     * AssociatedId 公网 IPv6 绑定的资源ID。
     * 可能为网卡ID或负载均衡ID。
     */
    public ?string $associatedId = null;

    /**
     * AssociatedType 公网 IPv6 绑定的资源类型。
     */
    public ?string $associatedType = null;

    /**
     * NicId 公网 IPv6 绑定的网卡ID。
     * 当且仅当`associatedType`字段为`NIC`时有值。
     */
    public ?string $nicId = null;

    /**
     * InstanceId 公网 IPv6 绑定的实例ID。
     * 当且仅当`associatedType`字段为`NIC`且该网卡已绑定实例时有值。
     */
    public ?string $instanceId = null;

    /**
     * InternetChargeType 公网 IPv6 的网络计费方式。
     */
    public ?string $internetChargeType = null;

    /**
     * Bandwidth 公网 IPv6 的带宽限速。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;

    /**
     * TrafficPackageSize 公网 IPv6 的流量包大小。
     * 单位：TB。
     * 仅当网络计费方式为流量包计费时可取到值。
     */
    public ?float $trafficPackageSize = null;

    /**
     * BandwidthCluster 关联的带宽组信息。
     * 仅当网络计费方式为共享带宽包计费时可取到值。
     */
    public ?BandwidthClusterInfo $bandwidthCluster = null;

    /**
     * ResourceGroupId 公网 IPv6 所属的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 公网 IPv6 所属的资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * CreateTime 公网 IPv6 的创建时间。
     */
    public ?string $createTime = null;

    /**
     * OperationInfo 公网 IPv6 的带宽、流量包操作状态。
     * 操作已完成时该字段为空。
     */
    public ?OperationInfo $operationInfo = null;
}
