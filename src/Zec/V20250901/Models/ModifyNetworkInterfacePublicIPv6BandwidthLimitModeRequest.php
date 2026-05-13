<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyNetworkInterfacePublicIPv6BandwidthLimitModeRequest extends AbstractModel
{
    /**
     * Ipv6CidrId IPv6 CIDR的ID。
     */
    public ?string $ipv6CidrId = null;

    /**
     * RateLimitMode 新的限速模式。
     */
    public ?string $rateLimitMode = null;
}
