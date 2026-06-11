<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceModifyIpv6BandwidthRequest
 */
class InquiryPriceModifyIpv6BandwidthRequest extends AbstractModel
{
    /**
     * Ipv6Id 要操作的公网IPv6。
     */
    public ?string $ipv6Id = null;

    /**
     * Bandwidth 调整后的带宽上限。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;
}
