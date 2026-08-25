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
 * DescribeDisksRequest
 */
class DescribeDisksRequest extends AbstractModel
{
    /**
     * DiskIds 根据云盘ID列表筛选。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /**
     * DiskName 根据云盘名称筛选，该字段支持模糊搜索。
     */
    public ?string $diskName = null;

    /**
     * DiskStatus 根据云盘的状态进行筛选。
     */
    public ?string $diskStatus = null;

    /**
     * DiskType 根据云盘的类型进行筛选。
     */
    public ?string $diskType = null;

    /**
     * DiskCategory 根据云盘的分类进行筛选。
     */
    public ?string $diskCategory = null;

    /**
     * InstanceId 根据云盘挂载的实例ID进行筛选。
     */
    public ?string $instanceId = null;

    /**
     * ZoneId 根据云盘所在的可用区进行筛选。
     */
    public ?string $zoneId = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * RegionId 根据云盘所在的节点ID进行筛选。
     */
    public ?string $regionId = null;

    /**
     * SnapshotAbility 根据云盘是否有快照能力进行筛选。
     */
    public ?bool $snapshotAbility = null;

    /**
     * ResourceGroupId 根据快照所属的资源组进行筛选。
     */
    public ?string $resourceGroupId = null;

    /**
     * TagKeys 根据标签键进行搜索。
     * 最长不得超过20个标签键。
     *
     * @var list<string>|null
     */
    public ?array $tagKeys = null;

    /**
     * Tags 根据标签进行搜索。
     * 最长不得超过20个标签。
     *
     * @var list<Tag>|null
     */
    public ?array $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
        'tagKeys' => 'string',
    ];
}
