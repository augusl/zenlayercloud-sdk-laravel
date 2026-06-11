<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceCreateInstanceResponseParams
 */
class InquiryPriceCreateInstanceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SpecPrice 规格的价格。
     */
    public ?PriceItem $specPrice = null;

    /**
     * GpuPrice GPU规格的价格。
     */
    public ?PriceItem $gpuPrice = null;

    /**
     * Ipv4Price 公网IPv4的保留价格。仅当`internetChargeType`有值时返回。
     */
    public ?PriceItem $ipv4Price = null;

    /**
     * Ipv4BandwidthPrice 公网IPv4的带宽价格。仅当`internetChargeType`有值时返回。
     */
    public ?PriceItem $ipv4BandwidthPrice = null;

    /**
     * Ipv4BandwidthPrices 各流量方向的IPv4带宽价格明细。仅当`internetChargeType`有值时返回。PathBasedBandwidthIP 线路返回多项（ipv4BandwidthPrice 为 null）；其他线路返回单项（trafficType=ALL）。
     *
     * @var BandwidthPriceResponseItem[]|null
     */
    public ?array $ipv4BandwidthPrices = null;

    /**
     * Ipv6Price 公网IPv6的价格。仅当`internetChargeType`有值时返回。
     */
    public ?PriceItem $ipv6Price = null;

    /**
     * Ipv6BandwidthPrice 公网IPv6的带宽价格。仅当`internetChargeType`有值时返回。
     */
    public ?PriceItem $ipv6BandwidthPrice = null;

    /**
     * SystemDiskPrice 系统盘的价格。
     */
    public ?PriceItem $systemDiskPrice = null;

    /**
     * DataDiskPrice 数据盘的价格。
     */
    public ?PriceItem $dataDiskPrice = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ipv4BandwidthPrices' => BandwidthPriceResponseItem::class,
    ];
}
