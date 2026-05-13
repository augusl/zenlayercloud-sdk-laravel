<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceCreateDisksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataDiskPrice 云硬盘价格。
     */
    public ?PriceItem $dataDiskPrice = null;
}
