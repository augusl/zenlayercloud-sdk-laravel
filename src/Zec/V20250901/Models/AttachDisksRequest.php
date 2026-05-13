<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AttachDisksRequest
 */
class AttachDisksRequest extends AbstractModel
{
    /**
     * DiskIds 需要挂载的云硬盘ID列表。
     */
    public ?array $diskIds = null;

    /**
     * InstanceId 被挂载的实例ID。
     */
    public ?string $instanceId = null;
}
