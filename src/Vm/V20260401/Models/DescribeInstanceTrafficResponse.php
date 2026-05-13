<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceTrafficResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?DescribeInstanceTrafficResponseParams $response = null;
}
