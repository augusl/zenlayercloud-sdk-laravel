<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeCrossRegionBandwidthRegionsResponseParams
 */
class DescribeCrossRegionBandwidthRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RegionIds 支持售卖内网跨区域带宽的节点ID集合。
     */
    public ?array $regionIds = null;
}
