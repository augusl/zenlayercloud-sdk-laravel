<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AssociateHaVipRequest
 */
class AssociateHaVipRequest extends AbstractModel
{
    /**
     * HaVipId 高可用虚拟IP的ID。
     */
    public ?string $haVipId = null;

    /**
     * InstanceId 要绑定的实例ID。
     * 实例网卡必须与HaVip处于同一子网。
     */
    public ?string $instanceId = null;
}
