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
     * Ipv4Price 公网IPv4的保留价格。
     */
    public ?PriceItem $ipv4Price = null;

    /**
     * Ipv4BandwidthPrice 公网IPv4的带宽价格。
     */
    public ?PriceItem $ipv4BandwidthPrice = null;

    /**
     * Ipv6Price IPv6的价格。
     */
    public ?PriceItem $ipv6Price = null;

    /**
     * Ipv6BandwidthPrice IPv6的带宽价格。
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
}
