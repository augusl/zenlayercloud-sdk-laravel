<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeAvailableBorderGatewayRequest
 */
class DescribeAvailableBorderGatewayRequest extends AbstractModel
{
    /**
     * NatGatewayId NAT网关 ID。
     */
    public ?string $natGatewayId = null;
}
