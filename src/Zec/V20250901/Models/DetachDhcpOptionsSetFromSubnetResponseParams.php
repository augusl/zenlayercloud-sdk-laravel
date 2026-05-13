<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DetachDhcpOptionsSetFromSubnetResponseParams
 */
class DetachDhcpOptionsSetFromSubnetResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedSubnetIds 操作失败的subnet ID集合。
     */
    public ?array $failedSubnetIds = null;
}
