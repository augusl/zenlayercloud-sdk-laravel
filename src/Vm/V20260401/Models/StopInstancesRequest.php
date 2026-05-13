<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class StopInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 一个或多个待操作的实例ID。
     */
    public ?array $instanceIds = null;

    /**
     * ForceShutdown 是否强制关机。
     * 如果不指定默认为是。
     */
    public ?bool $forceShutdown = null;
}
