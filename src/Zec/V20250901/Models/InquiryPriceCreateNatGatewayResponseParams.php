<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceCreateNatGatewayResponseParams
 */
class InquiryPriceCreateNatGatewayResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * NatGatewayPrice NAT网关的价格。
     */
    public ?PriceItem $natGatewayPrice = null;

    /**
     * CuPrice NAT网关CU的价格。
     */
    public ?PriceItem $cuPrice = null;
}
