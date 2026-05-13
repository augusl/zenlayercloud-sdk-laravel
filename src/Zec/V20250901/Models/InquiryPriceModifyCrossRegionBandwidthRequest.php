<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceModifyCrossRegionBandwidthRequest
 */
class InquiryPriceModifyCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * CrossRegionBandwidthId 要修改的内网跨区域带宽ID。
     */
    public ?string $crossRegionBandwidthId = null;

    /**
     * Bandwidth 带宽|保底带宽。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;
}
