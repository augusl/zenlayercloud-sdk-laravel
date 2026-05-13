<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class TerminateDiskRequest extends AbstractModel
{
    /**
     * DiskId 云硬盘ID。
     */
    public ?string $diskId = null;
}
