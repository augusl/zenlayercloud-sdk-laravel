<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * StopInstancesRequest
 */
class StopInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 待关闭的实例ID。
     */
    public ?array $instanceIds = null;

    /**
     * ForceShutdown 是否强制关机。
     */
    public ?bool $forceShutdown = null;
}
