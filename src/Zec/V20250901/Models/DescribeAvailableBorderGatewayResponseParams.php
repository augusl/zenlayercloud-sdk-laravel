<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeAvailableBorderGatewayResponseParams
 */
class DescribeAvailableBorderGatewayResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ZbgId 可绑定NAT的边界网关ID。
     */
    public ?string $zbgId = null;
}
