<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceStatus 描述实例的状态。
 */
class InstanceStatus extends AbstractModel
{
    /**
     * InstanceId 实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceStatus 实例状态。
     */
    public ?string $instanceStatus = null;
}
