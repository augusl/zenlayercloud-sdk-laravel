<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceInstanceTrafficPackageResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TrafficPackagePrice 流量包价格。
     *
     * @var PriceItem[]|null
     */
    public ?array $trafficPackagePrice = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'trafficPackagePrice' => PriceItem::class,
    ];
}
