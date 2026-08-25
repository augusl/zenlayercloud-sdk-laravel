<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeQosPolicyGroupsRequest extends AbstractModel
{
    /**
     * QosPolicyGroupIds QoS策略组ID列表。
     * 最多支持100个ID查询。
     *
     * @var list<string>|null
     */
    public ?array $qosPolicyGroupIds = null;

    /**
     * RegionId QoS策略组所在地域ID。
     */
    public ?string $regionId = null;

    /**
     * ResourceGroupId 根据资源组ID进行过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceId 成员资源ID（EIP、IPv6或UNMANAGED出口IP的console侧UUID）。
     * 返回包含该资源的策略组。
     */
    public ?string $resourceId = null;

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
        'qosPolicyGroupIds' => 'string',
        'tagKeys' => 'string',
    ];
}
