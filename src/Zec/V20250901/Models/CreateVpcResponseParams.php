<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateVpcResponseParams
 */
class CreateVpcResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * VpcId 创建的VPC ID。
     */
    public ?string $vpcId = null;
}
