<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeCidrPriceResponseParams
 */
class DescribeCidrPriceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * CidrPrice CIDR的价格信息。
     */
    public ?PriceItem $cidrPrice = null;
}
