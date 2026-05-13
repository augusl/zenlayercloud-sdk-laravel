<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifySubnetStackTypeResponseParams
 */
class ModifySubnetStackTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Ipv6CidrBlock 分配的IPv6地址段。
     */
    public ?string $ipv6CidrBlock = null;
}
