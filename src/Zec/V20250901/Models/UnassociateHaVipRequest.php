<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * UnassociateHaVipRequest
 */
class UnassociateHaVipRequest extends AbstractModel
{
    /**
     * HaVipId 高可用虚拟IP的ID。
     */
    public ?string $haVipId = null;

    /**
     * InstanceId 要解绑的实例ID。
     */
    public ?string $instanceId = null;
}
