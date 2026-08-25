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
 * DescribePoolsRequest
 */
class DescribePoolsRequest extends AbstractModel
{
    /**
     * PoolIds 根据公网IP池的ID。
     *
     * @var list<string>|null
     */
    public ?array $poolIds = null;

    /**
     * RegionId 根据公网IP池的所在节点ID过滤。
     */
    public ?string $regionId = null;

    /**
     * Name 根据公网IP池的名称过滤。
     * 支持模糊查询。
     */
    public ?string $name = null;

    /**
     * PageSize 返回的分页大小，默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'poolIds' => 'string',
    ];
}
