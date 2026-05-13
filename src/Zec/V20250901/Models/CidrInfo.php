<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CidrInfo CIDR信息详情。
 */
class CidrInfo extends AbstractModel
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
     * CidrBlock CIDR地址块，例如：10.0.0.0/16。
     */
    public ?string $cidrBlock = null;

    /**
     * TotalCount CIDR中IP地址的总数量。
     */
    public ?int $totalCount = null;

    /**
     * UsedCount CIDR中已被使用的IP地址数量。
     */
    public ?int $usedCount = null;

    /**
     * Source CIDR的来源。
     * 如CONSOLE（属于zenlayer）或 BYOIP（客户自带IP）。
     */
    public ?string $source = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type EIP网络类型。
     * 表示该CIDR支持的公网IP线路类型。
     * 已废弃，请参考`networkLineType`。
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType EIP网络类型。
     * 表示该CIDR支持的公网IP线路类型。
     */
    public ?string $networkLineType = null;

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
     * ResourceGroupId 该CIDR所属的资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 该CIDR所属资源组的名称。
     */
    public ?string $resourceGroupName = null;

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
