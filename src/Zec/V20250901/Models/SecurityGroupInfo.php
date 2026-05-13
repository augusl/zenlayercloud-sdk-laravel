<?php

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
     */
    public ?array $vpcIds = null;

    /**
     * IsDefault 是否是默认安全组。
     */
    public ?bool $isDefault = null;

    /**
     * NicIdList 关联安全组的网卡ID列表。
     */
    public ?array $nicIdList = null;

    /**
     * NatIdList 关联安全组的NAT网关ID列表。
     */
    public ?array $natIdList = null;

    /**
     * LoadBalancerIdList 关联安全组的负载均衡ID列表。
     */
    public ?array $loadBalancerIdList = null;
}
