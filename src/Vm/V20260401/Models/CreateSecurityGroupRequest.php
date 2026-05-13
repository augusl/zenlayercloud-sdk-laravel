<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateSecurityGroupRequest extends AbstractModel
{
    /**
     * SecurityGroupName 安全组名称。
     * 范围1到64个字符，仅支持字母、数字、-和英文句点(.)。
     */
    public ?string $securityGroupName = null;

    /**
     * RuleInfos 安全组规则。
     *
     * @var RuleInfo[]|null
     */
    public ?array $ruleInfos = null;

    /**
     * Description 安全组描述。
     * 范围2到256个字符。
     */
    public ?string $description = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ruleInfos' => RuleInfo::class,
    ];
}
