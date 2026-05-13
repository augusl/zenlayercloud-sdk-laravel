<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceCreateCrossRegionBandwidthResponseParams
 */
class InquiryPriceCreateCrossRegionBandwidthResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * CrossRegionBandwidthPrice 内网跨区域带宽的价格。
     */
    public ?PriceItem $crossRegionBandwidthPrice = null;
}
