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
 * IPTransitIpAddress IP Transit公网 IP 地址信息。
 */
class IPTransitIpAddress extends AbstractModel
{
    /**
     * IpUuid IP 块 UUID。
     * 变更（升降级/删除）时作为 ipUuid 传入。
     */
    public ?string $ipUuid = null;

    /**
     * IpAddress IP 地址（CIDR 表示法，如 192.0.2.0/30）。
     */
    public ?string $ipAddress = null;

    /**
     * Netmask 掩码长度。
     */
    public ?int $netmask = null;

    /**
     * GatewayIpAddress 网关 IP。
     */
    public ?string $gatewayIpAddress = null;

    /**
     * IpType IP 类型（IPV4 / IPV6）。
     */
    public ?string $ipType = null;

    /**
     * IpNetworkType IP 网络类型（BGP_IP / LOCAL_IP）。
     */
    public ?string $ipNetworkType = null;
}
