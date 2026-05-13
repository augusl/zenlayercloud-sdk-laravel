<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class TerminateInstanceResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?TerminateInstanceResponseParams $response = null;
}
