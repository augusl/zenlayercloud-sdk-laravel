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
 * HaLink HA 子链路信息。
 */
class HaLink extends AbstractModel
{
    /**
     * IsPrimary 当前是否为主线。
     * ACTIVE_STANDBY 模式下动态反映主备切换状态；ACTIVE_ACTIVE 模式下为 null。
     */
    public ?bool $isPrimary = null;

    /**
     * IptStatus 子链路业务状态。
     */
    public ?string $iptStatus = null;

    /**
     * ConnectivityStatus 子链路连通性状态。
     */
    public ?string $connectivityStatus = null;

    /**
     * PrivateConnectId 所属 VLL ID。
     */
    public ?string $privateConnectId = null;

    /**
     * PrivateConnectName 所属 VLL 名称。
     */
    public ?string $privateConnectName = null;

    /**
     * PeerPortId 对端数据中心端口 ID。
     */
    public ?string $peerPortId = null;

    /**
     * PeerPortName 对端数据中心端口名称。
     */
    public ?string $peerPortName = null;

    /**
     * PeerDataCenter 数据中心端口所在数据中心。
     */
    public ?DatacenterInfo $peerDataCenter = null;

    /**
     * PeerPortVlan VLAN ID。
     */
    public ?int $peerPortVlan = null;

    /**
     * Interconnect 互联 IP 配置。
     */
    public ?Interconnect $interconnect = null;
}
