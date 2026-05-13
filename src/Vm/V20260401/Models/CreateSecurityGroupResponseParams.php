<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateSecurityGroupResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;
}
