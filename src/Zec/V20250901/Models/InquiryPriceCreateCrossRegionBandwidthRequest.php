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
 * InquiryPriceCreateCrossRegionBandwidthRequest
 */
class InquiryPriceCreateCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * InternetChargeType 网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * MarketingInfo 市场营销的相关选项。
     */
    public ?MarketingInfo $marketingInfo = null;

    /**
     * RegionA 其中一端的区域连接点（A）。
     */
    public ?string $regionA = null;

    /**
     * RegionZ 另一端的区域连接点（Z）。
     */
    public ?string $regionZ = null;

    /**
     * Bandwidth 带宽|保底带宽。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;
}
