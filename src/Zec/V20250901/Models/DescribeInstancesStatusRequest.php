<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

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
     *
     * @var list<string>|null
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

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
