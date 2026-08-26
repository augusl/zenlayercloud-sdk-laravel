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
 * InquiryModifyIPTransitPriceResponseParams
 */
class InquiryModifyIPTransitPriceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * PrivateConnectPrice 专线（VLL）价格。
     * BANDWIDTH 类型时可能有值，Router RIPT 为空。
     */
    public ?PriceItem $privateConnectPrice = null;

    /**
     * PrivateConnectBandwidth 专线带宽（Mbps）。
     * BANDWIDTH 类型时有值。
     */
    public ?int $privateConnectBandwidth = null;

    /**
     * IptPrice RIPT 带宽价格。
     */
    public ?PriceItem $iptPrice = null;

    /**
     * IptIpPrices 公网 CIDR 块价格列表。
     * ADD_CIDR_BLOCK、EXPAND_CIDR_BLOCK 类型时有值。
     *
     * @var list<IPTransitIpPriceItem>|null
     */
    public ?array $iptIpPrices = null;

    /**
     * PublicInterconnectIpPrice 公网互联块价格。
     * 启用公网互联时填充，否则为空。
     */
    public ?IPTransitIpPriceItem $publicInterconnectIpPrice = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'iptIpPrices' => IPTransitIpPriceItem::class,
    ];
}
