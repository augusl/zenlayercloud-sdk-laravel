<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyDisksResourceGroupRequest extends AbstractModel
{
    /**
     * DiskIds 云硬盘ID列表。
     * 每次请求允许操作的云硬盘数量上限是100。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
    ];
}
