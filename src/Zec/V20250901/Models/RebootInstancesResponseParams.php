<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RebootInstancesResponseParams
 */
class RebootInstancesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceIds 重启操作失败的实例ID列表。
     */
    public ?array $instanceIds = null;
}
