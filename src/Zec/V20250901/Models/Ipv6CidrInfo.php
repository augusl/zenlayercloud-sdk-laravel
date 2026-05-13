<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * Ipv6CidrInfo IPv6 CIDR信息详情。
 */
class Ipv6CidrInfo extends AbstractModel
{
    /**
     * CidrId CIDR ID。
     */
    public ?string $cidrId = null;

    /**
     * RegionId CIDR所属的区域节点ID。
     */
    public ?string $regionId = null;

    /**
     * Name CIDR的名称。
     */
    public ?string $name = null;

    /**
     * CidrBlock CIDR地址块，例如：2400:8a00::/28。
     */
    public ?string $cidrBlock = null;

    /**
     * Source CIDR的来源。
     * 如CONSOLE（属于zenlayer）或 BYOIP（客户自带IP）。
     */
    public ?string $source = null;

    /**
     * NetworkLineType CIDR网络类型。
     * 表示该CIDR支持的公网IP线路类型。
     */
    public ?string $networkLineType = null;

    /**
     * SubnetIds 子网ID集合。
     */
    public ?array $subnetIds = null;

    /**
     * NicIds 网卡ID集合。
     */
    public ?array $nicIds = null;

    /**
     * Netmask 子网掩码。
     * 表示CIDR的网络位长度。
     */
    public ?int $netmask = null;

    /**
     * PoolId Pool的ID。
     * 表示该CIDR所属的公网IP池。
     */
    public ?string $poolId = null;

    /**
     * CreateTime CIDR的创建时间。
     */
    public ?string $createTime = null;

    /**
     * ExpiredTime CIDR的到期时间。
     */
    public ?string $expiredTime = null;

    /**
     * ResourceGroup 该CIDR所属的资源组。
     */
    public ?ResourceGroupInfo $resourceGroup = null;

    /**
     * Status CIDR的状态。
     */
    public ?string $status = null;

    /**
     * Asn ASN编号。
     * 仅当CIDR来源为BYOIP时存在。
     */
    public ?int $asn = null;

    /**
     * Tags 该CIDR地址段关联的标签。
     */
    public ?Tags $tags = null;
}
