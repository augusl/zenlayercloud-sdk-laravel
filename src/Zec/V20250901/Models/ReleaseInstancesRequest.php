<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ReleaseInstancesRequest
 */
class ReleaseInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 要释放的实例ID列表。
     */
    public ?array $instanceIds = null;
}
