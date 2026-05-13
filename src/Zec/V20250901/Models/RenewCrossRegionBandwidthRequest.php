<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RenewCrossRegionBandwidthRequest
 */
class RenewCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * CrossRegionBandwidthId 要恢复的内网跨区域带宽ID。
     */
    public ?string $crossRegionBandwidthId = null;
}
