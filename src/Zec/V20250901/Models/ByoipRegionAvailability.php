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
 * ByoipRegionAvailability 区域的BYOIP支持情况。
 */
class ByoipRegionAvailability extends AbstractModel
{
    /**
     * RegionId 区域ID。
     */
    public ?string $regionId = null;

    /**
     * Location 区域所在城市。
     */
    public ?string $location = null;

    /**
     * LineAvailabilities 各线路的BYOIP支持状态。
     *
     * @var list<ByoipLineAvailability>|null
     */
    public ?array $lineAvailabilities = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'lineAvailabilities' => ByoipLineAvailability::class,
    ];
}
