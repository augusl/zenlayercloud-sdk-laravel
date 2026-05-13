<?php

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
     */
    public ?array $zoneIds = null;
}
