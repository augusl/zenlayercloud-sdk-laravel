<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeBorderGatewaysRequest extends AbstractModel
{
    /**
     * ZbgIds 根据边界网关ID列表过滤。
     *
     * @var list<string>|null
     */
    public ?array $zbgIds = null;

    /**
     * Name 根据网关名称过滤。
     * 支持模糊搜索。
     */
    public ?string $name = null;

    /**
     * RegionId 根据边界网关所在的节点过滤。
     */
    public ?string $regionId = null;

    /**
     * VpcId 根据边界网关所属的VPC ID过滤。
     */
    public ?string $vpcId = null;

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
        'zbgIds' => 'string',
    ];
}
