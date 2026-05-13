<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateSubnetResponseParams
 */
class CreateSubnetResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SubnetId 创建的子网ID。
     */
    public ?string $subnetId = null;
}
