<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * NicInfo 描述网卡的相关信息。
 */
class NicInfo extends AbstractModel
{
    /**
     * NicId 网卡的ID。
     */
    public ?string $nicId = null;

    /**
     * Name 网卡的名称。
     */
    public ?string $name = null;

    /**
     * Status 网卡状态。
     */
    public ?string $status = null;

    /**
     * NicType 网卡类型。
     */
    public ?string $nicType = null;

    /**
     * RegionId 所属节点ID。
     */
    public ?string $regionId = null;

    /**
     * NicSubnetType 网卡的IP堆栈类型。
     */
    public ?string $nicSubnetType = null;

    /**
     * PublicIpList 关联的公网IP。
     */
    public ?array $publicIpList = null;

    /**
     * PrivateIpList 关联的内网IP。
     */
    public ?array $privateIpList = null;

    /**
     * PrimaryIpv4 主的内网IPv4地址。
     */
    public ?string $primaryIpv4 = null;

    /**
     * PrimaryIpv6 网卡上的主IPv6地址。
     * 如果堆栈类型是V4,该值取值为空。
     */
    public ?string $primaryIpv6 = null;

    /**
     * Ipv6Cidr 网卡上的IPv6地址。
     * 如果堆栈类型是V4,该值取值为空。
     */
    public ?string $ipv6Cidr = null;

    /**
     * SecondaryIpv4s 网卡上的辅助 IPv4 地址。
     */
    public ?array $secondaryIpv4s = null;

    /**
     * MacAddress 网卡的MAC地址。
     */
    public ?string $macAddress = null;

    /**
     * InstanceId 所绑定的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * VpcId 所关联VPC ID。
     */
    public ?string $vpcId = null;

    /**
     * SubnetId 所关联的子网ID。
     */
    public ?string $subnetId = null;

    /**
     * CreateTime 网卡的创建时间。
     */
    public ?string $createTime = null;

    /**
     * UpdateTime 网卡的更新时间。
     */
    public ?string $updateTime = null;

    /**
     * ResourceGroup 网卡所属的资源组信息。
     */
    public ?ResourceGroupInfo $resourceGroup = null;

    /**
     * SecurityGroupId 网卡关联的安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * Tags 该网卡关联的标签。
     */
    public ?Tags $tags = null;
}
