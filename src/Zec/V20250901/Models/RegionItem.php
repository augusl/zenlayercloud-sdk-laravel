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
     * Location 节点所在城市。
     * 例如 asia-east-1 对应 Shanghai。
     * 区域配置缺失时为null。
     */
    public ?string $location = null;

    /**
     * WideRegionName 节点所属大区的标识。
     * 例如 EMEA。
     */
    public ?string $wideRegionName = null;

    /**
     * WideRegionTitle 节点所属大区的展示名。
     * 例如 Europe and Middle East。
     */
    public ?string $wideRegionTitle = null;

    /**
     * AdministrativeRegion 节点所属的行政区划。
     * 区域配置缺失时为null。
     */
    public ?string $administrativeRegion = null;
}
