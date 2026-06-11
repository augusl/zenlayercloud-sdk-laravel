<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceChangeIpv6InternetChargeTypeRequest
 */
class InquiryPriceChangeIpv6InternetChargeTypeRequest extends AbstractModel
{
    /**
     * Ipv6Id 要操作的公网IPv6。
     */
    public ?string $ipv6Id = null;

    /**
     * InternetChargeType 要变更的目标网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * Bandwidth 带宽限速。
     * 单位：Mbps。
     * 网络计费方式为按带宽计费（`ByBandwidth`）时需指定。
     */
    public ?int $bandwidth = null;

    /**
     * FlowPackage 流量包大小。
     * 单位：TB。
     * 网络计费方式为流量包计费（`ByTrafficPackage`）时需指定。
     */
    public ?float $flowPackage = null;
}
