<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * StepPrice 描述阶梯价格的信息。
 */
class StepPrice extends AbstractModel
{
    /**
     * StepStart 阶梯的起始值。
     */
    public ?float $stepStart = null;

    /**
     * StepEnd 阶梯的到达值。
     * 为null代表最后一级阶梯。
     */
    public ?float $stepEnd = null;

    /**
     * UnitPrice 阶梯单价。
     */
    public ?float $unitPrice = null;

    /**
     * DiscountUnitPrice 阶梯折后价。
     */
    public ?float $discountUnitPrice = null;
}
