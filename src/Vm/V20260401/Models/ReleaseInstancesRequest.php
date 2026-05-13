<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ReleaseInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 一个或多个待操作的实例ID。
     */
    public ?array $instanceIds = null;
}
