<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DiskWithInstance 实例与关联的云盘信息。
 */
class DiskWithInstance extends AbstractModel
{
    /**
     * InstanceId 实例ID。
     */
    public ?string $instanceId = null;

    /**
     * DiskIdSet 随机器创建的数据盘ID集合。
     *
     * @var list<string>|null
     */
    public ?array $diskIdSet = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIdSet' => 'string',
    ];
}
