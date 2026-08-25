<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceTypeStatusResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceId 虚拟机实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceName 实例的名称。
     */
    public ?string $instanceName = null;

    /**
     * InstanceType 当前实例的机型。
     */
    public ?string $instanceType = null;

    /**
     * ModifiedInstanceType 实例将要修改的机型。
     */
    public ?string $modifiedInstanceType = null;

    /**
     * ModifiedInstanceTypeStatus 实例机型状态。
     * Processing：变更中。
     * Enable：可用。
     * WaitToEnable：下周期变更。
     */
    public ?string $modifiedInstanceTypeStatus = null;
}
