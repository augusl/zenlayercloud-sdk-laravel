<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteCidrsResponseParams
 */
class DeleteCidrsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedCidrIds 操作失败的CIDR ID列表。
     */
    public ?array $failedCidrIds = null;
}
