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
 * DescribeCidrsRequest
 */
class DescribeCidrsRequest extends AbstractModel
{
    /**
     * CidrIds 一个或多个待操作的Cidr ID，根据cidrId进行过滤。
     *
     * @var list<string>|null
     */
    public ?array $cidrIds = null;

    /**
     * RegionId 根据CIDR所在的节点ID进行过滤。
     */
    public ?string $regionId = null;

    /**
     * Name 根据CIDR名称进行过滤，支持模糊查询。
     */
    public ?string $name = null;

    /**
     * CidrBlock 根据CIDR地址进行过滤。
     */
    public ?string $cidrBlock = null;

    /**
     * Source 根据CIDR来源进行过滤。
     */
    public ?string $source = null;

    /**
     * Asn 根据ASN编号进行过滤。
     */
    public ?int $asn = null;

    /**
     * ResourceGroupId 根据资源组ID进行过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * PageSize 返回的分页大小，默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
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
        'cidrIds' => 'string',
        'tagKeys' => 'string',
    ];
}
