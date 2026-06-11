<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * VmInventoryCapacityInfo 可用区库存相关信息。
 */
class VmInventoryCapacityInfo extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * Capacity 档位。
     * 库存容量根据所有机型可售核数定义。
     */
    public ?string $capacity = null;
}
