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
 * Ipv6PreviousPrices 变更前各计费项当前生效的价格。
 */
class Ipv6PreviousPrices extends AbstractModel
{
    /**
     * Ipv6Price 变更前公网IPv6的保留价格。
     */
    public ?PriceItem $ipv6Price = null;

    /**
     * BandwidthPrice 变更前公网IPv6的带宽价格。
     */
    public ?PriceItem $bandwidthPrice = null;
}
