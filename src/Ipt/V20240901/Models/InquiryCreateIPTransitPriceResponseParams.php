<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryCreateIPTransitPriceResponseParams
 */
class InquiryCreateIPTransitPriceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * PrivateConnectPrice 二层网络专线价格。
     * 可能为空。
     */
    public ?PriceItem $privateConnectPrice = null;

    /**
     * IptBandwidthPrice IP Transit带宽价格。
     */
    public ?PriceItem $iptBandwidthPrice = null;

    /**
     * PublicIpPrices 公网 IP 价格列表。
     *
     * @var list<IPPrice>|null
     */
    public ?array $publicIpPrices = null;

    /**
     * PublicInterconnectIpPrice 公网互联 IP 价格。
     * 仅 publicInterconnectNetmask 非空时返回。
     */
    public ?IPPrice $publicInterconnectIpPrice = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'publicIpPrices' => IPPrice::class,
    ];
}
