<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceChangeIpv6InternetChargeTypeResponseParams
 */
class InquiryPriceChangeIpv6InternetChargeTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Ipv6Price 公网IPv6的保留价格。
     */
    public ?PriceItem $ipv6Price = null;

    /**
     * BandwidthPrice 公网IPv6的带宽价格。
     */
    public ?PriceItem $bandwidthPrice = null;
}
