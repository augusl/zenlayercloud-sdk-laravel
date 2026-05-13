<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AssociateEipAddressResponseParams
 */
class AssociateEipAddressResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedEipIds 绑定失败的IP。
     */
    public ?array $failedEipIds = null;
}
