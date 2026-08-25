<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class AttachDisksRequest extends AbstractModel
{
    /**
     * DiskIds 云硬盘ID集合。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /**
     * InstanceId 需要挂载的实例ID。
     */
    public ?string $instanceId = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
    ];
}
