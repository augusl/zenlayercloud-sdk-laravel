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
 * DescribeByoipRegionAvailabilityResponseParams
 */
class DescribeByoipRegionAvailabilityResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Regions 区域的BYOIP支持情况列表。
     *
     * @var list<ByoipRegionAvailability>|null
     */
    public ?array $regions = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regions' => ByoipRegionAvailability::class,
    ];
}
