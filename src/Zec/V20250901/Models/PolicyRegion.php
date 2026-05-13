<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * PolicyRegion 区域的基本信息。
 */
class PolicyRegion extends AbstractModel
{
    /**
     * RegionId 区域ID。
     */
    public ?string $regionId = null;

    /**
     * RegionName 国家名称。
     */
    public ?string $regionName = null;

    /**
     * AreaName 地域名称。
     */
    public ?string $areaName = null;
}
