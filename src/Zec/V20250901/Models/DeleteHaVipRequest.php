<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteHaVipRequest
 */
class DeleteHaVipRequest extends AbstractModel
{
    /**
     * HaVipId 高可用虚拟IP的ID。
     */
    public ?string $haVipId = null;
}
