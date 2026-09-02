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
 * InquiryPriceChangeIpv6InternetChargeTypeResponseParams
 */
class InquiryPriceChangeIpv6InternetChargeTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Ipv6Price 公网IPv6的保留价格。
     */
    public ?PriceItem $ipv6Price = null;

    /**
     * BandwidthPrice 公网IPv6的带宽价格。
     */
    public ?PriceItem $bandwidthPrice = null;

    /**
     * PreviousPrices 变更前各计费项当前生效的价格，字段与上方一一对应，用于对比出哪些计费项发生了调价。
     * 无订单时为 null。
     */
    public ?Ipv6PreviousPrices $previousPrices = null;
}
