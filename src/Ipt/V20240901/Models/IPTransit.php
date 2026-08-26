<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * IPTransit IP Transit信息。
 */
class IPTransit extends AbstractModel
{
    /**
     * IptId IP Transit ID。
     */
    public ?string $iptId = null;

    /**
     * IptName IP Transit名称。
     */
    public ?string $iptName = null;

    /**
     * IptDescription IP Transit描述。
     */
    public ?string $iptDescription = null;

    /**
     * DataCenter IP Transit所在数据中心。
     */
    public ?DatacenterInfo $dataCenter = null;

    /**
     * PeerPortId 对端数据中心端口 ID。
     */
    public ?string $peerPortId = null;

    /**
     * PeerPortName 对端数据中心端口名称。
     */
    public ?string $peerPortName = null;

    /**
     * PeerDataCenter 对端数据中心端口所在数据中心。
     */
    public ?DatacenterInfo $peerDataCenter = null;

    /**
     * DeliveryType 开通方式。
     */
    public ?string $deliveryType = null;

    /**
     * ResourceGroupId 资源组 ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * RoutingType 路由模式。
     */
    public ?string $routingType = null;

    /**
     * InternetType 网络计费方式。
     */
    public ?string $internetType = null;

    /**
     * Bandwidth 带宽（Mbps）。
     */
    public ?int $bandwidth = null;

    /**
     * CommitBandwidth 保底带宽（Mbps）。
     */
    public ?int $commitBandwidth = null;

    /**
     * Bfd BFD 配置。
     */
    public ?BFDConfig $bfd = null;

    /**
     * Bgp BGP 相关配置。
     */
    public ?RiptBgpConfig $bgp = null;

    /**
     * Interconnect 互联地址配置。
     */
    public ?Interconnect $interconnect = null;

    /**
     * PrivateConnectId 关联的 VLL ID。
     */
    public ?string $privateConnectId = null;

    /**
     * PrivateConnectName 关联的 VLL 名称。
     */
    public ?string $privateConnectName = null;

    /**
     * PublicIpv4Addresses 公网 IPv4 地址列表。
     *
     * @var list<IPAddress>|null
     */
    public ?array $publicIpv4Addresses = null;

    /**
     * IptStatus 业务状态。
     */
    public ?string $iptStatus = null;

    /**
     * ConnectivityStatus 链路连通性状态。
     */
    public ?string $connectivityStatus = null;

    /**
     * Tags 该IP Transit关联的标签。
     */
    public ?Tags $tags = null;

    /**
     * PublicIpAddresses 公网 IP 地址列表。
     *
     * @var list<IPTransitIpAddress>|null
     */
    public ?array $publicIpAddresses = null;

    /**
     * HaMode 高可用模式。
     */
    public ?string $haMode = null;

    /**
     * ZbgRegionId ZBG 区域 ID。
     * ZBG 场景下的 IP Transit 将返回此字段。
     */
    public ?string $zbgRegionId = null;

    /**
     * PeerPortType 对端数据中心端口类型。
     */
    public ?string $peerPortType = null;

    /**
     * HaLinks HA 子链路列表。
     * 非 HA 模式下为 null；HA 模式下含两个子链路对象。
     *
     * @var list<HaLink>|null
     */
    public ?array $haLinks = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'publicIpv4Addresses' => IPAddress::class,
        'publicIpAddresses' => IPTransitIpAddress::class,
        'haLinks' => HaLink::class,
    ];
}
