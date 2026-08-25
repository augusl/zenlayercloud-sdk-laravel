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
 * SecurityGroupInfo 描述安全组的基本信息。
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
     * Scope 范围。
     * 目前只有全球范围(`Global`)。
     */
    public ?string $scope = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * VpcIds 关联的VPC ID列表。
     *
     * @var list<string>|null
     */
    public ?array $vpcIds = null;

    /**
     * IsDefault 是否是默认安全组。
     */
    public ?bool $isDefault = null;

    /**
     * NicIdList 关联安全组的网卡ID列表。
     *
     * @var list<string>|null
     */
    public ?array $nicIdList = null;

    /**
     * NatIdList 关联安全组的NAT网关ID列表。
     *
     * @var list<string>|null
     */
    public ?array $natIdList = null;

    /**
     * LoadBalancerIdList 关联安全组的负载均衡ID列表。
     *
     * @var list<string>|null
     */
    public ?array $loadBalancerIdList = null;

    /**
     * HaVipIdList 关联安全组的高可用虚拟IP ID列表。
     *
     * @var list<string>|null
     */
    public ?array $haVipIdList = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'vpcIds' => 'string',
        'nicIdList' => 'string',
        'natIdList' => 'string',
        'loadBalancerIdList' => 'string',
        'haVipIdList' => 'string',
    ];
}
