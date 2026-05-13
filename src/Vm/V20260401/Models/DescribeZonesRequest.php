<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeZonesRequest extends AbstractModel
{
    /**
     * ZoneIds 可用区ID集合。
     */
    public ?array $zoneIds = null;
}
