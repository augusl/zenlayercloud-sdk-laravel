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
 * DescribeNetworkInterfacePermissionsRequest
 */
class DescribeNetworkInterfacePermissionsRequest extends AbstractModel
{
    /**
     * NicIds 根据网卡ID过滤。
     * 最多传入100个ID。
     *
     * @var list<string>|null
     */
    public ?array $nicIds = null;

    /**
     * PermissionIds 根据网卡授权ID过滤。
     * 最多传入100个ID。
     *
     * @var list<string>|null
     */
    public ?array $permissionIds = null;

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
        'nicIds' => 'string',
        'permissionIds' => 'string',
    ];
}
