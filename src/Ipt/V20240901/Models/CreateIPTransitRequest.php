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
 * CreateIPTransitRequest
 */
class CreateIPTransitRequest extends AbstractModel
{
    /**
     * IptName IP Transit名称。
     */
    public ?string $iptName = null;

    /**
     * IptDescription IP Transit描述。
     */
    public ?string $iptDescription = null;

    /**
     * PeerPortId 对端数据中心端口 ID。
     */
    public ?string $peerPortId = null;

    /**
     * PeerPortVlan 对端数据中心端口 VLAN。
     */
    public ?int $peerPortVlan = null;

    /**
     * IptDcId 本端数据中心 ID。
     * 为空代表本地连接（Local IPT）。
     * 传 `haConfig` 创建高可用 IP Transit 时必传。
     */
    public ?string $iptDcId = null;

    /**
     * InternetType 网络计费方式。
     */
    public ?string $internetType = null;

    /**
     * CommitBandwidth 保底带宽（Mbps）。
     * 95 计费（internetType=ByInstanceBandwidth95）下必传。
     */
    public ?int $commitBandwidth = null;

    /**
     * Bandwidth 带宽（Mbps）。
     * 95 计费（internetType=ByInstanceBandwidth95）下必须大于等于 `commitBandwidth`。
     */
    public ?int $bandwidth = null;

    /**
     * RoutingType 路由模式。
     */
    public ?string $routingType = null;

    /**
     * PublicIPv4BlockSize 公网 IPv4 地址段大小列表。
     * 与 `publicIpList` 互斥，优先级更低。
     *
     * @var list<int>|null
     */
    public ?array $publicIPv4BlockSize = null;

    /**
     * Bfd BFD 配置。
     * 传 `haConfig` 创建高可用 IP Transit 时必传，且后续不允许关闭。
     */
    public ?BFDConfig $bfd = null;

    /**
     * ResourceGroupId 资源组 ID。
     * 不传则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * Bgp BGP相关配置。
     */
    public ?RiptBgpConfig $bgp = null;

    /**
     * Tags 创建CIDR时关联的标签。
     * 注意：关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /**
     * PublicIpList 公网 IP 分配列表。
     * 与 `publicIPv4BlockSize` 互斥，优先级更高。
     * 传此字段时 `publicIPv4BlockSize` 被忽略。
     *
     * @var list<IPTransitIpRequest>|null
     */
    public ?array $publicIpList = null;

    /**
     * ZbgRegionId ZBG 接入节点 ID。
     * 非空时走 Router RIPT 流程，与 `haConfig` 互斥。
     * 调用 ~~zec:DescribeInterconnectBorderGatewayRegions~~ 以获取可用的节点信息。
     */
    public ?string $zbgRegionId = null;

    /**
     * HaConfig HA 高可用配置。
     * 非空时走 HA 创建流程，与 `zbgRegionId` 互斥，且此时 `iptDcId` 和 `bfd` 均必传。
     */
    public ?IPTransitHaConfig $haConfig = null;

    /**
     * PublicInterconnectNetmask 公网互联块掩码。
     * 非空启用公网地址互联，仅 BGP / Static 路由支持。
     * 合法值见 ~~DescribeIPTransitDatacenters~~ 响应中 availableRoutingTypes[].publicInterconnectNetmasks。
     */
    public ?int $publicInterconnectNetmask = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'publicIpList' => IPTransitIpRequest::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'publicIPv4BlockSize' => 'int',
    ];
}
