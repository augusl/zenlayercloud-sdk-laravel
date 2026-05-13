<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RenewEipRequest
 */
class RenewEipRequest extends AbstractModel
{
    /**
     * EipId 要恢复弹性公网IP的ID。
     */
    public ?string $eipId = null;
}
