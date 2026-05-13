<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RenewCidrRequest
 */
class RenewCidrRequest extends AbstractModel
{
    /**
     * CidrId 要恢复的CIDR ID。
     */
    public ?string $cidrId = null;
}
