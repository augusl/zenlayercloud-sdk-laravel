<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeEipPriceResponseParams
 */
class DescribeEipPriceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * EipPrice 公网弹性IP的保留价格。
     * 如果是通过cidr创建，则保留价格为null。
     */
    public ?PriceItem $eipPrice = null;

    /**
     * BandwidthPrice 公网弹性IP的带宽价格。
     */
    public ?PriceItem $bandwidthPrice = null;

    /**
     * RemoteBandwidthPrice Remote IPT的带宽价格。
     */
    public ?PriceItem $remoteBandwidthPrice = null;
}
