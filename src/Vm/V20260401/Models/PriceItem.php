<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * PriceItem 描述价格的信息。
 */
class PriceItem extends AbstractModel
{
    /**
     * Discount 折扣大小。
     * 如80.0代表8折。
     */
    public ?float $discount = null;

    /**
     * DiscountPrice 后付费的单元折后价格。
     * 后付费模式使用，如果价格为阶梯价格，该项为null。
     */
    public ?float $discountPrice = null;

    /**
     * OriginalPrice 预付费的原价。
     * 预付费模式使用，后付费该值为 null。
     */
    public ?float $originalPrice = null;

    /**
     * UnitPrice 后付费的单元原始价格。
     * 后付费模式使用，如果价格为阶梯价格，该项为null。
     */
    public ?float $unitPrice = null;

    /**
     * DiscountUnitPrice 后付费的单元折后价格。
     * 后付费模式使用，如果价格为阶梯价格，该项为null。
     */
    public ?float $discountUnitPrice = null;

    /**
     * ChargeUnit 后付费计价单元。
     * 后付费模式使用，可取值范围：<br/>HOUR: 表示计价单元是按每小时来计算。
     * DAY: 表示计价单元是按天来计算。
     * MONTH: 表示计价单元是按月来计算，95计费则是这种。
     */
    public ?string $chargeUnit = null;

    /**
     * StepPrices 后付费阶梯价格。
     * 后付费模式使用，如果非阶梯价格，该项为null。
     *
     * @var StepPrice[]|null
     */
    public ?array $stepPrices = null;

    /**
     * AmountUnit 用量单位。
     * 比如Mbps, LCU等。
     * 如果为null, 代表取不到值。
     */
    public ?string $amountUnit = null;

    /**
     * ExcessUnitPrice 超量原始价格。
     */
    public ?float $excessUnitPrice = null;

    /**
     * ExcessDiscountUnitPrice 超量折扣后价格。
     */
    public ?float $excessDiscountUnitPrice = null;

    /**
     * ExcessAmountUnit 超量用量单位。
     * 如果为null, 代表取不到值。
     */
    public ?string $excessAmountUnit = null;

    /**
     * Category 价格所属类别。
     */
    public ?string $category = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'stepPrices' => StepPrice::class,
    ];
}
