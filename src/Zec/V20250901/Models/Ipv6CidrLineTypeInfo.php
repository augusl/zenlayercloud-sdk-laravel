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
 * Ipv6CidrLineTypeInfo IPv6 CIDR某个掩码档位下单条线路的可售信息。
 */
class Ipv6CidrLineTypeInfo extends AbstractModel
{
    /**
     * NetworkLineType IP线路类型。
     */
    public ?string $networkLineType = null;

    /**
     * Stock 该掩码、该线路当前可购买的CIDR数量。
     */
    public ?int $stock = null;

    /**
     * Price 该掩码、该线路的单价信息。
     */
    public ?PriceItem $price = null;
}
