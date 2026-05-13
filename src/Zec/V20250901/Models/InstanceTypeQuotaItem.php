<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceTypeQuotaItem 描述实例规格的售卖信息。
 */
class InstanceTypeQuotaItem extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType 实例规格ID。
     */
    public ?string $instanceType = null;

    /**
     * InstanceTypeName 实例规格的名称。
     */
    public ?string $instanceTypeName = null;

    /**
     * CpuCount CPU核数。
     * 单位：核。
     */
    public ?int $cpuCount = null;

    /**
     * Memory 实例内存容量。
     * 单位：GiB。
     */
    public ?int $memory = null;

    /**
     * InternetMaxBandwidthOutLimit 最大出口带宽限制。
     */
    public ?int $internetMaxBandwidthOutLimit = null;

    /**
     * WithStock 是否有库存。
     */
    public ?bool $withStock = null;

    /**
     * InternetChargeTypes 支持的网络计费类型。
     */
    public ?array $internetChargeTypes = null;
}
