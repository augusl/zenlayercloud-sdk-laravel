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
 * CreateSecurityGroupRequest
 */
class CreateSecurityGroupRequest extends AbstractModel
{
    /**
     * Scope 范围。
     * 目前只支持`Global`。
     */
    public ?string $scope = null;

    /**
     * SecurityGroupName 安全组名称。
     * 范围1到64个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     */
    public ?string $securityGroupName = null;

    /**
     * RuleInfos 安全组的规则。
     *
     * @var list<SecurityGroupRuleInfo>|null
     */
    public ?array $ruleInfos = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ruleInfos' => SecurityGroupRuleInfo::class,
    ];
}
