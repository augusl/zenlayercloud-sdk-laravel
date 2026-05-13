<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceAvailableSecurityGroup 描述实例可绑定的安全组信息。
 */
class InstanceAvailableSecurityGroup extends AbstractModel
{
    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * SecurityGroupName 安全组名称。
     */
    public ?string $securityGroupName = null;

    /**
     * IsDefault 安全组是否默认。
     */
    public ?bool $isDefault = null;
}
