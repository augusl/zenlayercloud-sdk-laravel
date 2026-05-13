<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class StartInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 一个或多个待操作的虚拟机实例ID。
     */
    public ?array $instanceIds = null;
}
