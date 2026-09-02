<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceChangeEipInternetChargeTypeResponseParams
 */
class InquiryPriceChangeEipInternetChargeTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * EipPrice 公网弹性IP的保留价格。
     * 通过CIDR创建的IP保留价格为null。
     */
    public ?PriceItem $eipPrice = null;

    /**
     * BandwidthPrice 公网弹性IP的带宽价格。
     * PathBasedBandwidthIP线路时为null，详见`bandwidthPrices`。
     */
    public ?PriceItem $bandwidthPrice = null;

    /**
     * BandwidthPrices 各流量方向的带宽价格明细。
     * PathBasedBandwidthIP线路返回多项；其他线路返回单项（trafficType=ALL）。
     *
     * @var list<BandwidthPriceResponseItem>|null
     */
    public ?array $bandwidthPrices = null;

    /**
     * RemoteBandwidthPrice Remote IPT的带宽价格。
     * EIP未开启Remote IPT时为null。
     */
    public ?PriceItem $remoteBandwidthPrice = null;

    /**
     * PreviousPrices 变更前各计费项当前生效的价格，字段与上方一一对应，用于对比出哪些计费项发生了调价。
     * 无订单时为 null。
     */
    public ?EipPreviousPrices $previousPrices = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'bandwidthPrices' => BandwidthPriceResponseItem::class,
    ];
}
