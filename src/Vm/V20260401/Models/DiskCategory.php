<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DiskCategory 云盘类型。
 */
class DiskCategory extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * CategorySet 该可用区支持的云硬盘种类集合。
     *
     * @var list<string>|null
     */
    public ?array $categorySet = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'categorySet' => 'string',
    ];
}
