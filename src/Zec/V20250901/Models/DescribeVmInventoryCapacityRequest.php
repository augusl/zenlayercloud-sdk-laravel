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
 * DescribeVmInventoryCapacityRequest
 */
class DescribeVmInventoryCapacityRequest extends AbstractModel
{
    /**
     * RegionIds 节点 ID 列表，格式如 asia-north-1。
     * 不传则返回全部节点。
     *
     * @var list<string>|null
     */
    public ?array $regionIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'regionIds' => 'string',
    ];
}
