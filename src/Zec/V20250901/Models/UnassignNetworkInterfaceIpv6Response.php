<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class UnassignNetworkInterfaceIpv6Response extends AbstractModel
{
    public ?string $requestId = null;

    public ?UnassignNetworkInterfaceIpv6ResponseParams $response = null;
}
