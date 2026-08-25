<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifySecurityGroupsAttributeRequest extends AbstractModel
{
    /**
     * SecurityGroupName 安全组名称。
     * 范围1到64个字符，仅支持字母、数字、-和英文句点(.)。
     */
    public ?string $securityGroupName = null;

    /**
     * Description 安全组描述。
     * 范围2到256个字符。
     */
    public ?string $description = null;

    /**
     * SecurityGroupIds 一个或多个待操作的安全组ID。
     * 每次请求批量上限为100。
     *
     * @var list<string>|null
     */
    public ?array $securityGroupIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'securityGroupIds' => 'string',
    ];
}
