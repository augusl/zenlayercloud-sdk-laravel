<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * UnassociateEipAddressRequest
 */
class UnassociateEipAddressRequest extends AbstractModel
{
    /**
     * EipIds 要解绑的弹性公网IP的ID列表。
     */
    public ?array $eipIds = null;
}
