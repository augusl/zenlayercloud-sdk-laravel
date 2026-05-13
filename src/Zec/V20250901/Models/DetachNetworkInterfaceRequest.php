<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DetachNetworkInterfaceRequest
 */
class DetachNetworkInterfaceRequest extends AbstractModel
{
    /**
     * NicId 需要操作的网卡ID。
     */
    public ?string $nicId = null;
}
