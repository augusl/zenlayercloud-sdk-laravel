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
 * EipPreviousPrices 变更前各计费项当前生效的价格。
 */
class EipPreviousPrices extends AbstractModel
{
    /**
     * EipPrice 变更前公网弹性IP的保留价格。
     */
    public ?PriceItem $eipPrice = null;

    /**
     * BandwidthPrice 变更前公网弹性IP的带宽价格。
     * 与顶层同义：PathBasedBandwidthIP线路时为null，明细见`previousPrices.bandwidthPrices`。
     */
    public ?PriceItem $bandwidthPrice = null;

    /**
     * BandwidthPrices 变更前各流量方向的带宽价格明细，与顶层`bandwidthPrices`按`trafficType`一一对应。
     *
     * @var list<BandwidthPriceResponseItem>|null
     */
    public ?array $bandwidthPrices = null;

    /**
     * RemoteBandwidthPrice 变更前Remote IPT的带宽价格。
     * EIP未开启Remote IPT时为null。
     */
    public ?PriceItem $remoteBandwidthPrice = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'bandwidthPrices' => BandwidthPriceResponseItem::class,
    ];
}
