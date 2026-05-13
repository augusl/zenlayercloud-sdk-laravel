<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceInstanceBandwidthResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * BandwidthPrice 公网带宽价格。
     *
     * @var PriceItem[]|null
     */
    public ?array $bandwidthPrice = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'bandwidthPrice' => PriceItem::class,
    ];
}
