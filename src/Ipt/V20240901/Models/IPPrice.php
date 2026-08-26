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
 * IPPrice IP 价格信息。
 */
class IPPrice extends AbstractModel
{
    /**
     * Price 价格详情。
     */
    public ?PriceItem $price = null;

    /**
     * Netmask 掩码长度。
     */
    public ?int $netmask = null;

    /**
     * Qty 数量。
     */
    public ?int $qty = null;

    /**
     * IpNetworkType IP 网络类型。
     */
    public ?string $ipNetworkType = null;
}
