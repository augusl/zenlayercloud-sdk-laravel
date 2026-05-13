<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeImageQuotaRequest extends AbstractModel
{
    /**
     * ZoneIds 可用区ID列表。
     * 可从DescribeZones的zoneId中获取。
     */
    public ?array $zoneIds = null;
}
