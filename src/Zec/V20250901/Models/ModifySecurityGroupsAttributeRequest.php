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
 * ModifySecurityGroupsAttributeRequest
 */
class ModifySecurityGroupsAttributeRequest extends AbstractModel
{
    /**
     * SecurityGroupName 安全组名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     */
    public ?string $securityGroupName = null;

    /**
     * SecurityGroupIds 要操作的安全组ID列表。
     *
     * @var list<string>|null
     */
    public ?array $securityGroupIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'securityGroupIds' => 'string',
    ];
}
