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
 * IPTransitIpRequest 公网 IP 分配请求。
 */
class IPTransitIpRequest extends AbstractModel
{
    /**
     * Netmask CIDR 掩码长度。
     * IPv4 有效范围 24–30，IPv6 有效范围 48–64。
     */
    public ?int $netmask = null;

    /**
     * IpType IP 类型（IPV4 / IPV6）。
     */
    public ?string $ipType = null;

    /**
     * IpNetworkType IP 类型。
     * 默认 BGP_IP（从 IP 池分配）。
     * LOCAL_IP 表示原生 IP。
     */
    public ?string $ipNetworkType = null;

    /**
     * Amount 购买数量。
     * 指定相同掩码长度的 IP 块数量，默认为 1。
     */
    public ?int $amount = null;
}
