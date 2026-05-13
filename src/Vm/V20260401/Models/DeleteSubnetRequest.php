<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteSubnetRequest extends AbstractModel
{
    /**
     * SubnetId 子网的ID。
     */
    public ?string $subnetId = null;
}
