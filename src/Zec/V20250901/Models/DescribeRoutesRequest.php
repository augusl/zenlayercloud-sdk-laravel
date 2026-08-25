<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeRoutesRequest extends AbstractModel
{
    /**
     * RouteIds 根据路由ID过滤。
     * 最多同时传入100个ID。
     *
     * @var list<string>|null
     */
    public ?array $routeIds = null;

    /**
     * VpcId 根据路由关联的VPC ID过滤。
     */
    public ?string $vpcId = null;

    /**
     * IpVersion 根据IP类型过滤。
     * 支持`IPv4`和`IPv6`两种类型。
     */
    public ?string $ipVersion = null;

    /**
     * RouteType 根据路由类型过滤。
     */
    public ?string $routeType = null;

    /**
     * Name 根据名称类型过滤。
     * 该字段支持模糊搜索。
     */
    public ?string $name = null;

    /**
     * DestinationCidrBlock 根据Ipv4或IPv6的目标网段过滤。
     * 例如：10.0.1.0/24。
     */
    public ?string $destinationCidrBlock = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'routeIds' => 'string',
    ];
}
