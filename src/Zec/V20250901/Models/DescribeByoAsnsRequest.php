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
 * DescribeByoAsnsRequest
 */
class DescribeByoAsnsRequest extends AbstractModel
{
    /**
     * ByoAsnIds BYO ASN 的ID列表。
     * 最多支持100个ID查询。
     *
     * @var list<string>|null
     */
    public ?array $byoAsnIds = null;

    /**
     * Asn 根据ASN号进行精确过滤。
     */
    public ?int $asn = null;

    /**
     * Status 根据状态进行过滤。
     */
    public ?string $status = null;

    /**
     * ResourceGroupId 根据资源组ID进行过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * OrderBy 排序字段。
     * 未指定时按创建时间排序。
     */
    public ?string $orderBy = null;

    /**
     * Direction 排序方向。
     * 未指定时为降序。
     */
    public ?string $direction = null;

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
        'byoAsnIds' => 'string',
        'tagKeys' => 'string',
    ];
}
