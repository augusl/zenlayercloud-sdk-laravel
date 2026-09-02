<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class StopInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 一个或多个待操作的实例ID。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * ForceShutdown 是否强制关机。
     * 不指定时默认为 true。详见 https://docs.console.zenlayer.com/api-reference/compute/vm/virtual-machine-instance/stopinstances
     */
    public ?bool $forceShutdown = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
