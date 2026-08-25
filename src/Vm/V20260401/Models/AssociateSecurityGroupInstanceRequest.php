<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class AssociateSecurityGroupInstanceRequest extends AbstractModel
{
    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * InstanceId 实例ID。
     */
    public ?string $instanceId = null;
}
