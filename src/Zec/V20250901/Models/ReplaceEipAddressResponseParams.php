<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ReplaceEipAddressResponseParams
 */
class ReplaceEipAddressResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedEipIds 替换失败的IP的ID集合。
     */
    public ?array $failedEipIds = null;
}
