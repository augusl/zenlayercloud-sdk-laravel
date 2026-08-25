<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeUnmanagedEgressIpsRequest extends AbstractModel
{
    /**
     * UnmanagedEgressIpIds 按照非托管出口IP的唯一ID过滤，每次请求最多支持100个。
     *
     * @var list<string>|null
     */
    public ?array $unmanagedEgressIpIds = null;

    /**
     * RegionId 按照节点ID过滤。
     */
    public ?string $regionId = null;

    /**
     * VpcId 按照所属VPC的唯一ID过滤。
     */
    public ?string $vpcId = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页页码。
     */
    public ?int $pageNum = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'unmanagedEgressIpIds' => 'string',
    ];
}
