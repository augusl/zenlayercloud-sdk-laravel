<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceAvailableSecurityGroupResourcesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceAvailableSecurityGroups 实例可绑定的安全组集合。
     *
     * @var InstanceAvailableSecurityGroup[]|null
     */
    public ?array $instanceAvailableSecurityGroups = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'instanceAvailableSecurityGroups' => InstanceAvailableSecurityGroup::class,
    ];
}
