<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyUnmanagedEgressIpBandwidthLimitModeRequest extends AbstractModel
{
    /**
     * UnmanagedEgressIpId 非托管出口IP的唯一ID。
     */
    public ?string $unmanagedEgressIpId = null;

    /**
     * RateLimitMode 新的限速模式。
     */
    public ?string $rateLimitMode = null;
}
