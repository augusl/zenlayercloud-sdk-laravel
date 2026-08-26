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
 * IPTransitIpPriceItem CIDR 块价格信息。
 */
class IPTransitIpPriceItem extends AbstractModel
{
    /**
     * Price 价格信息。
     */
    public ?PriceItem $price = null;

    /**
     * Netmask CIDR 掩码长度。
     */
    public ?int $netmask = null;

    /**
     * Amount 数量。
     */
    public ?int $amount = null;

    /**
     * IpNetworkType IP 网络类型（BGP_IP / LOCAL_IP）。
     */
    public ?string $ipNetworkType = null;
}
