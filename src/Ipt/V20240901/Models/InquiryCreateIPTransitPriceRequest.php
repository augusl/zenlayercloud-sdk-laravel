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
 * InquiryCreateIPTransitPriceRequest
 */
class InquiryCreateIPTransitPriceRequest extends AbstractModel
{
    /**
     * PeerPortId 对端数据中心端口 ID。
     */
    public ?string $peerPortId = null;

    /**
     * IptDcId 本端数据中心 ID。
     * 为空代表本地连接（Local IPT）。
     */
    public ?string $iptDcId = null;

    /**
     * InternetType 网络计费方式。
     */
    public ?string $internetType = null;

    /**
     * CommitBandwidth 保底带宽。
     * 单位Mbps。
     * 有且仅当internetType=ByInstanceBandwidth95时该字段必传。
     */
    public ?int $commitBandwidth = null;

    /**
     * Bandwidth 带宽限速。
     * 单位Mbps。
     * 最小值不能低于5Mbps。
     * 默认值为5Mbps。
     * 95 计费下必须大于等于 `commitBandwidth`。
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
     * BgpRouteType BGP入站路由类型。
     */
    public ?string $bgpRouteType = null;

    /**
     * IpType IP 类型（IPV4 / IPV6）。
     * 默认 IPV4。
     */
    public ?string $ipType = null;

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
     * 非空时走 Router RIPT 询价流程。
     */
    public ?string $zbgRegionId = null;

    /**
     * HaConfig HA 高可用配置。
     * 非空时询价包含 2 条 VLL 价格。
     */
    public ?IPTransitHaConfig $haConfig = null;

    /**
     * PublicInterconnectNetmask 公网互联块掩码。
     * 非空时响应包含公网互联 IP 块价格。
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
