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
 * InquiryPriceChangeUnmanagedEgressIpInternetChargeTypeResponseParams
 */
class InquiryPriceChangeUnmanagedEgressIpInternetChargeTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * BandwidthPrice 非托管出口IP的带宽价格。
     * 变更为共享带宽包计费（BandwidthCluster）时为null（免费）。
     */
    public ?PriceItem $bandwidthPrice = null;

    /**
     * PreviousPrices 变更前各计费项当前生效的价格，字段与上方一一对应，用于对比出哪些计费项发生了调价。
     * 无订单时为 null。
     */
    public ?UnmanagedEgressIpPreviousPrices $previousPrices = null;
}
