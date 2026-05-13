<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateNatGatewayResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * OrderNumber 下单编号。
     */
    public ?string $orderNumber = null;

    /**
     * NatGatewayId NAT网关唯一ID。
     */
    public ?string $natGatewayId = null;
}
