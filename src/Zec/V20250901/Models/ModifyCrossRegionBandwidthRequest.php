<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyCrossRegionBandwidthRequest
 */
class ModifyCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * CrossRegionBandwidthId 要调整的内网跨区域带宽ID。
     */
    public ?string $crossRegionBandwidthId = null;

    /**
     * Bandwidth 带宽|保底带宽。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * BandwidthCap 突发带宽。
     * 单位：Mbps。
     */
    public ?int $bandwidthCap = null;
}
