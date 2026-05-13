<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeZoneInstanceConfigInfosRequest
 */
class DescribeZoneInstanceConfigInfosRequest extends AbstractModel
{
    /**
     * ZoneId 要查询的可用区ID。
     * 例如：asia-east-1a。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType 要查询的实例规格。
     * 例如：z2a.cpu.1。
     */
    public ?string $instanceType = null;
}
