<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * UnassignNetworkInterfaceIpv6Request
 */
class UnassignNetworkInterfaceIpv6Request extends AbstractModel
{
    /**
     * NicId 要删除IPv6的网卡ID。
     */
    public ?string $nicId = null;
}
