<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceStatus 描述实例状态的信息。
 */
class InstanceStatus extends AbstractModel
{
    /**
     * InstanceId 实例的ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceStatus 实例的状态。
     */
    public ?string $instanceStatus = null;
}
