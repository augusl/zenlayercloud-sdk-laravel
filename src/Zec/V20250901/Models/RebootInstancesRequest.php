<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RebootInstancesRequest
 */
class RebootInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 待重启虚拟机实例ID列表。
     */
    public ?array $instanceIds = null;
}
