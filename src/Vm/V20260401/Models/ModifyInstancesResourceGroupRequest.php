<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyInstancesResourceGroupRequest extends AbstractModel
{
    /**
     * InstanceIds 虚拟机实例ID列表。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
