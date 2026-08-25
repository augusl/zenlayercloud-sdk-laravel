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
 * DescribeZonesRequest
 */
class DescribeZonesRequest extends AbstractModel
{
    /**
     * ZoneIds 根据可用区ID过滤。
     *
     * @var list<string>|null
     */
    public ?array $zoneIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'zoneIds' => 'string',
    ];
}
