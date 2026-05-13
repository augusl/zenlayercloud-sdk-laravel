<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteNetworkInterfaceRequest
 */
class DeleteNetworkInterfaceRequest extends AbstractModel
{
    /**
     * NicId 要删除的网卡ID。
     */
    public ?string $nicId = null;
}
