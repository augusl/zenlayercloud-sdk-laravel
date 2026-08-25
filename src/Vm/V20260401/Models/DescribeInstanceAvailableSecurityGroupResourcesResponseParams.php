<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceAvailableSecurityGroupResourcesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceAvailableSecurityGroups 实例可绑定的安全组集合。
     *
     * @var list<InstanceAvailableSecurityGroup>|null
     */
    public ?array $instanceAvailableSecurityGroups = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'instanceAvailableSecurityGroups' => InstanceAvailableSecurityGroup::class,
    ];
}
