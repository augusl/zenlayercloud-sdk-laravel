<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyInstancesResourceGroupRequest extends AbstractModel
{
    /**
     * InstanceIds 虚拟机实例ID列表。
     */
    public ?array $instanceIds = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;
}
