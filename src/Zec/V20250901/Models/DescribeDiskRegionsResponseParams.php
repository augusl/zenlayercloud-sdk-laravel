<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDiskRegionsResponseParams
 */
class DescribeDiskRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RegionIds 支持售卖云硬盘的节点ID列表。
     */
    public ?array $regionIds = null;
}
