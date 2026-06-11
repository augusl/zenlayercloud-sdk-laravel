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
     * BandwidthPrices 各流量方向的带宽价格明细。
     * PathBasedBandwidthIP 线路返回多项（bandwidthPrice 为 null）；其他线路返回单项（trafficType=ALL）。
     *
     * @var BandwidthPriceResponseItem[]|null
     */
    public ?array $bandwidthPrices = null;

    /**
     * RemoteBandwidthPrice Remote IPT的带宽价格。
     */
    public ?PriceItem $remoteBandwidthPrice = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'bandwidthPrices' => BandwidthPriceResponseItem::class,
    ];
}
