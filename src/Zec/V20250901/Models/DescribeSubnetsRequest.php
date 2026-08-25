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
 * DescribeSubnetsRequest
 */
class DescribeSubnetsRequest extends AbstractModel
{
    /**
     * SubnetIds 根据子网的ID进行筛选。
     *
     * @var list<string>|null
     */
    public ?array $subnetIds = null;

    /**
     * Name 根据子网的名称进行筛选。
     * 该字段支持模糊搜索。
     */
    public ?string $name = null;

    /**
     * CidrBlock 根据子网的CIDR进行筛选。
     */
    public ?string $cidrBlock = null;

    /**
     * RegionId 根据子网所在的节点进行筛选。
     */
    public ?string $regionId = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /**
     * VpcIds 根据所属VPC的ID进行筛选。最多支持100个VPC ID。
     *
     * @var list<string>|null
     */
    public ?array $vpcIds = null;

    /**
     * DhcpOptionsSetId 子网绑定的DHCP 选项集ID。
     */
    public ?string $dhcpOptionsSetId = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'subnetIds' => 'string',
        'vpcIds' => 'string',
    ];
}
