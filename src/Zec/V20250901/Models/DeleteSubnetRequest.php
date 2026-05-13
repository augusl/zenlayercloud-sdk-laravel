<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteSubnetRequest
 */
class DeleteSubnetRequest extends AbstractModel
{
    /**
     * SubnetId 要删除的子网ID。
     */
    public ?string $subnetId = null;
}
