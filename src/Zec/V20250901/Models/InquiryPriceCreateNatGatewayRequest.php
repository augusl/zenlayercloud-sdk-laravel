<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceCreateNatGatewayRequest extends AbstractModel
{
    /**
     * RegionId 区域节点ID。
     */
    public ?string $regionId = null;
}
