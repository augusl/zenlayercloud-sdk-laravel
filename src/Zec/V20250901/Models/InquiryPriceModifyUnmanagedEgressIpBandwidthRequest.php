<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceModifyUnmanagedEgressIpBandwidthRequest
 */
class InquiryPriceModifyUnmanagedEgressIpBandwidthRequest extends AbstractModel
{
    /**
     * UnmanagedEgressIpId 要操作的非托管出口IP。
     */
    public ?string $unmanagedEgressIpId = null;

    /**
     * Bandwidth 调整后的带宽上限。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;
}
