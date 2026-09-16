<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeIpv6AddressesRequest extends AbstractModel
{
    /**
     * Ipv6Ids 按照公网 IPv6 的唯一 ID 过滤。
     * 最大不能超过100个。
     *
     * @var list<string>|null
     */
    public ?array $ipv6Ids = null;

    /**
     * RegionId 按照公网 IPv6 所属节点ID过滤。
     */
    public ?string $regionId = null;

    /**
     * Ipv6Cidr 按照公网 IPv6 的 CIDR 地址段过滤，该字段支持模糊匹配。
     */
    public ?string $ipv6Cidr = null;

    /**
     * Status 按照公网 IPv6 的状态过滤。
     */
    public ?string $status = null;

    /**
     * AssociatedIds 按照公网 IPv6 绑定的资源 ID 过滤。
     * 取值可以是网卡ID或负载均衡ID。
     *
     * @var list<string>|null
     */
    public ?array $associatedIds = null;

    /**
     * ResourceGroupId 按照公网 IPv6 所属的资源组ID过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * PageSize 返回的分页大小。
     * 当未传递时，默认值为20。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     * 当未传递时，默认值为1。
     */
    public ?int $pageNum = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'ipv6Ids' => 'string',
        'associatedIds' => 'string',
    ];
}
