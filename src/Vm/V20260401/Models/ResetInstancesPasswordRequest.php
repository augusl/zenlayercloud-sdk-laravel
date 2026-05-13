<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ResetInstancesPasswordRequest extends AbstractModel
{
    /**
     * InstanceIds 虚拟机实例ID集合。
     */
    public ?array $instanceIds = null;

    /**
     * Password 实例登录密码。
     */
    public ?string $password = null;
}
