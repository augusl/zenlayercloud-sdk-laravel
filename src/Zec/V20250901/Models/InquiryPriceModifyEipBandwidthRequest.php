<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceModifyEipBandwidthRequest
 */
class InquiryPriceModifyEipBandwidthRequest extends AbstractModel
{
    /**
     * EipId 要操作的公网弹性IP。
     */
    public ?string $eipId = null;

    /**
     * Bandwidth 调整后的带宽上限。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;
}
