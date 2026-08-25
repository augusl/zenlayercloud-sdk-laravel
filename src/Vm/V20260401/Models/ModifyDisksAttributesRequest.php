<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyDisksAttributesRequest extends AbstractModel
{
    /**
     * DiskIds 待修改属性的云硬盘ID集合。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /**
     * DiskName 新的云盘名称。
     * 必须以数字或字母开头或结尾，长度1-64字符，仅支持字母、数字、-和英文句点(.)。
     */
    public ?string $diskName = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
    ];
}
