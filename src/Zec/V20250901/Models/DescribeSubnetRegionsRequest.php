<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeSubnetRegionsRequest
 */
class DescribeSubnetRegionsRequest extends AbstractModel
{
    /**
     * RegionIds 根据节点ID过滤。
     */
    public ?array $regionIds = null;
}
