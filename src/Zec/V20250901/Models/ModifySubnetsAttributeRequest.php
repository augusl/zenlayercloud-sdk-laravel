<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifySubnetsAttributeRequest
 */
class ModifySubnetsAttributeRequest extends AbstractModel
{
    /**
     * SubnetIds 需要修改的子网ID列表。
     *
     * @var list<string>|null
     */
    public ?array $subnetIds = null;

    /**
     * Name 子网名称。
     * 长度为2到63个字符，必须以数字或字母开头和结尾，仅支持字母、数字、连字符(-)和英文句点(.)。
     */
    public ?string $name = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'subnetIds' => 'string',
    ];
}
