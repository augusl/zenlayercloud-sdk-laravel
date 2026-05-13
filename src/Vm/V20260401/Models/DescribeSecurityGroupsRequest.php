<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeSecurityGroupsRequest extends AbstractModel
{
    /**
     * SecurityGroupIds 安全组ID集合。
     * 最多支持100个ID查询。
     */
    public ?array $securityGroupIds = null;

    /**
     * SecurityGroupName 安全组名称。
     */
    public ?string $securityGroupName = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     * 默认为1。
     */
    public ?int $pageNum = null;
}
