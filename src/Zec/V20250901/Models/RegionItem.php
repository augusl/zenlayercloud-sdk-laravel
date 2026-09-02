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
 * RegionItem 节点的基本信息。
 */
class RegionItem extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * RegionName 节点名称。
     */
    public ?string $regionName = null;

    /**
     * AdministrativeRegion 节点所属的行政区划。
     * 区域配置缺失时为null。
     */
    public ?string $administrativeRegion = null;
}
