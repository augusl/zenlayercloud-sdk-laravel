<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * BandwidthPriceResponseItem 带宽价格明细。
 */
class BandwidthPriceResponseItem extends AbstractModel
{
    /**
     * TrafficType 流量方向类型。
     * LOCAL：境内；INTERNATIONAL：境外；ALL：全部方向。
     */
    public ?string $trafficType = null;

    /**
     * Price 该方向的带宽价格。
     */
    public ?PriceItem $price = null;
}
