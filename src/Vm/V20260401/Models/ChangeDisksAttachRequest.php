<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ChangeDisksAttachRequest extends AbstractModel
{
    /**
     * DiskIds 云硬盘ID集合。
     */
    public ?array $diskIds = null;

    /**
     * InstanceId 需要挂载的新实例ID。
     */
    public ?string $instanceId = null;
}
