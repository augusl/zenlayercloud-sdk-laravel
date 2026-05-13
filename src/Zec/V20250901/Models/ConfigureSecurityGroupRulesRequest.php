<?php

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
     * @var SecurityGroupRuleInfo[]|null
     */
    public ?array $ruleInfos = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ruleInfos' => SecurityGroupRuleInfo::class,
    ];
}
