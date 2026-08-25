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
 * NatGateway 描述NAT网关的信息。
 */
class NatGateway extends AbstractModel
{
    /**
     * NatGatewayId NAT网关唯一ID。
     */
    public ?string $natGatewayId = null;

    /**
     * VpcId NAT网关所属的VPC网络ID。
     */
    public ?string $vpcId = null;

    /**
     * RegionId 区域节点ID。
     */
    public ?string $regionId = null;

    /**
     * Status NAT网关的状态。
     */
    public ?string $status = null;

    /**
     * Name NAT网关的名称。
     */
    public ?string $name = null;

    /**
     * SubnetIds NAT网关所属的Subnet子网ID集合。
     *
     * @var list<string>|null
     */
    public ?array $subnetIds = null;

    /**
     * IsAllSubnets 是否节点内所有子网关联了NAT网关。
     */
    public ?bool $isAllSubnets = null;

    /**
     * EipIds NAT网关所关联的EIP ID集合。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * ZbgId 边界网关ID。
     */
    public ?string $zbgId = null;

    /**
     * IcmpReplyEnabled 是否开启ICMP代回。
     */
    public ?bool $icmpReplyEnabled = null;

    /**
     * SecurityGroupId 边界网关关联的安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * CreateTime 创建时间。
     * 按照ISO8601标准表示，并且使用UTC时间, 格式为：YYYY-MM-ddTHH:mm:ssZ。
     */
    public ?string $createTime = null;

    /**
     * ExpiredTime 到期时间。
     * 按照ISO8601标准表示，并且使用UTC时间, 格式为：YYYY-MM-ddTHH:mm:ssZ。
     */
    public ?string $expiredTime = null;

    /**
     * Tags 该CIDR地址段关联的标签。
     */
    public ?Tags $tags = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'subnetIds' => 'string',
        'eipIds' => 'string',
    ];
}
