<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class RevokeSecurityGroupRulesRequest extends AbstractModel
{
    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * RuleInfos 安全组规则。
     *
     * @var list<RuleInfo>|null
     */
    public ?array $ruleInfos = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ruleInfos' => RuleInfo::class,
    ];
}
