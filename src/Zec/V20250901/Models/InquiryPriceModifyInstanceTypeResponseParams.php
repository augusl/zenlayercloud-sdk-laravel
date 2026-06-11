<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceModifyInstanceTypeResponseParams
 */
class InquiryPriceModifyInstanceTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SpecPrice 变更后规格的价格。
     */
    public ?PriceItem $specPrice = null;

    /**
     * SystemDiskPrice 系统盘的价格。
     */
    public ?PriceItem $systemDiskPrice = null;
}
