<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeImageQuotaRequest extends AbstractModel
{
    /**
     * ZoneIds 可用区ID列表。
     * 可从DescribeZones的zoneId中获取。
     *
     * @var list<string>|null
     */
    public ?array $zoneIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'zoneIds' => 'string',
    ];
}
