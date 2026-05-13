<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class BatchAssignNetworkInterfaceIpv4ResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * IpAddresses 绑定的内网IP地址。
     */
    public ?array $ipAddresses = null;
}
