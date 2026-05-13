<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * StartInstancesResponseParams
 */
class StartInstancesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceIds 启动失败的实例ID列表。
     */
    public ?array $instanceIds = null;
}
