<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceChangeUnmanagedEgressIpInternetChargeTypeRequest
 */
class InquiryPriceChangeUnmanagedEgressIpInternetChargeTypeRequest extends AbstractModel
{
    /**
     * UnmanagedEgressIpId 要操作的非托管出口IP。
     */
    public ?string $unmanagedEgressIpId = null;

    /**
     * InternetChargeType 要变更的目标网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * Bandwidth 带宽限速。
     * 单位：Mbps。
     * 变更为按带宽计费（ByBandwidth）时必传。
     */
    public ?int $bandwidth = null;

    /**
     * FlowPackage 流量包大小。
     * 单位：TB，为0或0.1的倍数。
     * 变更为流量包计费（ByTrafficPackage）时必传。
     */
    public ?float $flowPackage = null;
}
