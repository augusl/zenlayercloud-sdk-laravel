<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ReleaseDiskRequest
 */
class ReleaseDiskRequest extends AbstractModel
{
    /**
     * DiskId 要删除的云硬盘ID。
     */
    public ?string $diskId = null;
}
