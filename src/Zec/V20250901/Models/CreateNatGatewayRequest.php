<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateNatGatewayRequest extends AbstractModel
{
    /**
     * RegionId 区域节点ID。
     */
    public ?string $regionId = null;

    /**
     * VpcId NAT网关所属的VPC网络ID。
     */
    public ?string $vpcId = null;

    /**
     * Name NAT网关的名称。
     * 长度为2～63个字符。
     */
    public ?string $name = null;

    /**
     * SubnetIds NAT网关所属的Subnet子网ID集合。
     * 如果未指定，则指定区域的所有子网将自动关联NAT网关。
     *
     * @var list<string>|null
     */
    public ?array $subnetIds = null;

    /**
     * SecurityGroupId 安全组ID。
     * 如果未指定，则指定VPC所属的安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * ResourceGroupId 资源组ID。
     * 如果不指定，则会创建在默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建NAT网关时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'subnetIds' => 'string',
    ];
}
