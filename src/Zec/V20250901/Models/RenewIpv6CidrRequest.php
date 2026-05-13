<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class RenewIpv6CidrRequest extends AbstractModel
{
    /**
     * CidrId IPv6 地址块ID。
     */
    public ?string $cidrId = null;
}
