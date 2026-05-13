<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AttachNetworkInterfaceRequest
 */
class AttachNetworkInterfaceRequest extends AbstractModel
{
    /**
     * NicId 需要操作的网卡ID。
     */
    public ?string $nicId = null;

    /**
     * InstanceId 需要绑定的实例ID。
     */
    public ?string $instanceId = null;
}
