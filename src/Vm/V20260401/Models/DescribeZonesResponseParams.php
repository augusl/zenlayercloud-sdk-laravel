<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeZonesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ZoneSet 区域信息集合。
     *
     * @var list<ZoneInfo>|null
     */
    public ?array $zoneSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'zoneSet' => ZoneInfo::class,
    ];
}
