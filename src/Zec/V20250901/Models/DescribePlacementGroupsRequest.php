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
 * DescribePlacementGroupsRequest
 */
class DescribePlacementGroupsRequest extends AbstractModel
{
    /**
     * PlacementGroupIds 根据置放组ID列表筛选。
     * 最多支持100个ID查询。
     *
     * @var list<string>|null
     */
    public ?array $placementGroupIds = null;

    /**
     * Name 根据置放组名称筛选。
     * 支持模糊匹配。
     */
    public ?string $name = null;

    /**
     * ZoneId 根据置放组所属可用区筛选。
     */
    public ?string $zoneId = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /**
     * ResourceGroupId 根据资源组ID筛选。
     */
    public ?string $resourceGroupId = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'placementGroupIds' => 'string',
    ];
}
