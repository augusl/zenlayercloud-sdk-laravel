<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeInstancesStatusRequest
 */
class DescribeInstancesStatusRequest extends AbstractModel
{
    /**
     * InstanceIds 要查询的实例ID列表。
     */
    public ?array $instanceIds = null;

    /**
     * PageSize 分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 分页页数。
     */
    public ?int $pageNum = null;

    /**
     * ResourceGroupId 根据资源组ID过滤。
     */
    public ?string $resourceGroupId = null;
}
