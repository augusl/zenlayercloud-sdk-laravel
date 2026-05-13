<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * StartInstancesRequest
 */
class StartInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 要启动的实例ID。
     */
    public ?array $instanceIds = null;
}
