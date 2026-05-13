<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribePolicyDetailResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?DescribePolicyDetailResponseParams $response = null;
}
