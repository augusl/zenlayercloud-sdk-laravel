<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DetachDisksResponseParams
 */
class DetachDisksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedDiskIds 解绑失败的云硬盘。
     */
    public ?array $failedDiskIds = null;
}
