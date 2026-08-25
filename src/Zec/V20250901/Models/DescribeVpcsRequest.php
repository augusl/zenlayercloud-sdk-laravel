<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeVpcsRequest extends AbstractModel
{
    /**
     * VpcIds VPC的ID列表。
     * 最多可传100个ID。
     *
     * @var list<string>|null
     */
    public ?array $vpcIds = null;

    /**
     * Name 根据VPC名称过滤。
     * 支持模糊查询。
     */
    public ?string $name = null;

    /**
     * CidrBlock 根据VPC的IPv4 CIDR过滤。
     * 支持模糊查询。
     */
    public ?string $cidrBlock = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /**
     * ResourceGroupId 根据资源组ID过滤。
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
        'vpcIds' => 'string',
        'tagKeys' => 'string',
    ];
}
