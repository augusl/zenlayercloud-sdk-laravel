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
 * UnmanagedEgressIpPreviousPrices 变更前各计费项当前生效的价格。
 */
class UnmanagedEgressIpPreviousPrices extends AbstractModel
{
    /**
     * BandwidthPrice 变更前非托管出口IP的带宽价格。
     */
    public ?PriceItem $bandwidthPrice = null;
}
