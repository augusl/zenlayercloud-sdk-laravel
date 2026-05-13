<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteVpcRequest
 */
class DeleteVpcRequest extends AbstractModel
{
    /**
     * VpcId 要删除的VPC ID。
     */
    public ?string $vpcId = null;
}
