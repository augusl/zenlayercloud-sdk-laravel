<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeIPTransitsRequest
 */
class DescribeIPTransitsRequest extends AbstractModel
{
    /**
     * IptIds IP Transit ID 列表。
     * 最多支持 100 个 ID 查询。
     *
     * @var list<string>|null
     */
    public ?array $iptIds = null;

    /**
     * IptName IP Transit名称。
     * 模糊匹配。
     */
    public ?string $iptName = null;

    /**
     * ResourceGroupId 资源组 ID。
     * 不传则返回该用户可见的所有资源组内的IP Transit。
     */
    public ?string $resourceGroupId = null;

    /**
     * PeerPortId 对端数据中心端口 ID 过滤。
     */
    public ?string $peerPortId = null;

    /**
     * IptDcId 本端数据中心 ID 过滤。
     */
    public ?string $iptDcId = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为 20，最大为 1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     * 默认为 1。
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
        'iptIds' => 'string',
        'tagKeys' => 'string',
    ];
}
