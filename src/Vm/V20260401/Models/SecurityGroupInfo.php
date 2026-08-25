<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * SecurityGroupInfo 安全组信息。
 */
class SecurityGroupInfo extends AbstractModel
{
    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * SecurityGroupName 安全组名称。
     */
    public ?string $securityGroupName = null;

    /**
     * SecurityGroupStatus 安全组状态。
     */
    public ?string $securityGroupStatus = null;

    /**
     * CreateTime 创建时间。
     * 格式为：YYYY-MM-DDThh:mm:ssZ。
     */
    public ?string $createTime = null;

    /**
     * Description 安全组描述。
     */
    public ?string $description = null;

    /**
     * InstanceIds 已绑定实例ID集合。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * RuleInfos 安全组规则。
     *
     * @var list<RuleInfo>|null
     */
    public ?array $ruleInfos = null;

    /**
     * IsDefault 是否默认。
     */
    public ?bool $isDefault = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ruleInfos' => RuleInfo::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
    ];
}
