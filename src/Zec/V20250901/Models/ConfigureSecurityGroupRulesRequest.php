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
 * ConfigureSecurityGroupRulesRequest
 */
class ConfigureSecurityGroupRulesRequest extends AbstractModel
{
    /**
     * SecurityGroupId 要配置的安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * RuleInfos 需要配置的安全组规则列表。
     * 注意：配置为全量覆盖。
     *
     * @var list<SecurityGroupRuleInfo>|null
     */
    public ?array $ruleInfos = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ruleInfos' => SecurityGroupRuleInfo::class,
    ];
}
