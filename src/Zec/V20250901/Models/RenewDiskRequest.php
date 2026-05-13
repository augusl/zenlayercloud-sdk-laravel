<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RenewDiskRequest
 */
class RenewDiskRequest extends AbstractModel
{
    /**
     * DiskId 要恢复的云硬盘ID。
     */
    public ?string $diskId = null;
}
