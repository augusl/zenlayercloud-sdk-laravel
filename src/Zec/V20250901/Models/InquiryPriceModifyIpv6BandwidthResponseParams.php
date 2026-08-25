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
 * InquiryPriceModifyIpv6BandwidthResponseParams
 */
class InquiryPriceModifyIpv6BandwidthResponseParams extends AbstractModel
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
}
