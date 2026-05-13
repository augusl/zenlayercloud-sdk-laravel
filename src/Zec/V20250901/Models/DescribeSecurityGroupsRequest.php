<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeSecurityGroupsRequest
 */
class DescribeSecurityGroupsRequest extends AbstractModel
{
    /**
     * SecurityGroupIds 根据安全组ID列表筛选。
     */
    public ?array $securityGroupIds = null;

    /**
     * SecurityGroupName 根据安全组名称筛选。
     * 支持模糊搜索。
     */
    public ?string $securityGroupName = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;
}
