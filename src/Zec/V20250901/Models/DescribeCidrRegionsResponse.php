<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeCidrRegionsResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?DescribeCidrRegionsResponseParams $response = null;
}
