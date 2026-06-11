<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeVmInventoryCapacityResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?DescribeVmInventoryCapacityResponseParams $response = null;
}
