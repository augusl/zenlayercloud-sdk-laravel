<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeVmInventoryCapacityRequest
 */
class DescribeVmInventoryCapacityRequest extends AbstractModel
{
    /**
     * RegionIds 节点 ID 列表，格式如 asia-north-1。
     * 不传则返回全部节点。
     */
    public ?array $regionIds = null;
}
