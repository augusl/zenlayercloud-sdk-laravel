<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeCidrRegionsResponseParams
 */
class DescribeCidrRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RegionIds 支持售卖CIDR的节点ID。
     */
    public ?array $regionIds = null;
}
