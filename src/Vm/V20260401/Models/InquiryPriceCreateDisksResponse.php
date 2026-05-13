<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceCreateDisksResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?InquiryPriceCreateDisksResponseParams $response = null;
}
