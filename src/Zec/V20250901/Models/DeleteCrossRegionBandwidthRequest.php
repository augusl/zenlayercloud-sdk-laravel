<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteCrossRegionBandwidthRequest
 */
class DeleteCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * CrossRegionBandwidthId 要删除内网跨区域带宽ID。
     */
    public ?string $crossRegionBandwidthId = null;
}
