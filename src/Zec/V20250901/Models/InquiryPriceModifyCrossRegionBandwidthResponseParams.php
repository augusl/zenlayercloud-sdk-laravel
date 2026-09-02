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
 * InquiryPriceModifyCrossRegionBandwidthResponseParams
 */
class InquiryPriceModifyCrossRegionBandwidthResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * CrossRegionBandwidthPrice 内网跨区域带宽的价格。
     */
    public ?PriceItem $crossRegionBandwidthPrice = null;

    /**
     * PreviousPrices 变更前各计费项当前生效的价格，字段与上方一一对应，用于对比出哪些计费项发生了调价。
     * 无订单时为 null。
     */
    public ?CrossRegionBandwidthPreviousPrices $previousPrices = null;
}
