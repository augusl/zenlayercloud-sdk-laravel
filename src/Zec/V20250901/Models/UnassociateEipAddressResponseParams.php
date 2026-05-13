<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * UnassociateEipAddressResponseParams
 */
class UnassociateEipAddressResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedEipIds 操作失败的弹性IP的ID集合。
     */
    public ?array $failedEipIds = null;
}
