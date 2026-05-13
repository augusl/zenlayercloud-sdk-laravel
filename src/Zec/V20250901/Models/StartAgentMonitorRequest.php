<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * StartAgentMonitorRequest
 */
class StartAgentMonitorRequest extends AbstractModel
{
    /**
     * InstanceId 要操作的实例ID。
     */
    public ?string $instanceId = null;
}
