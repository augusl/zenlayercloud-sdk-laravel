<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DetachDisksRequest extends AbstractModel
{
    /**
     * DiskIds 将要卸载的云硬盘ID集合。
     */
    public ?array $diskIds = null;
}
