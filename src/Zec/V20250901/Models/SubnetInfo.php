<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * SubnetInfo 描述子网的基本信息。
 */
class SubnetInfo extends AbstractModel
{
    /**
     * SubnetId 子网的ID。
     */
    public ?string $subnetId = null;

    /**
     * RegionId 子网所在节点的ID。
     */
    public ?string $regionId = null;

    /**
     * Name 子网的名称。
     */
    public ?string $name = null;

    /**
     * CidrBlock 子网的CIDR地址。
     */
    public ?string $cidrBlock = null;

    /**
     * GatewayIpAddress 网关地址。
     */
    public ?string $gatewayIpAddress = null;

    /**
     * Ipv6CidrBlock 子网的IPv6 CIDR地址段。
     * 如果子网的IP堆栈类型不包括V6,该字段取不到值。
     */
    public ?string $ipv6CidrBlock = null;

    /**
     * Ipv6GatewayIpAddress IPv6的网关地址。
     */
    public ?string $ipv6GatewayIpAddress = null;

    /**
     * StackType 子网的IP堆栈类型。
     */
    public ?string $stackType = null;

    /**
     * Ipv6Type 子网上IPv6类型。
     * 如果子网的IP堆栈类型不包括V6,该字段取不到值。
     */
    public ?string $ipv6Type = null;

    /**
     * VpcId 子网所属VPC的ID。
     */
    public ?string $vpcId = null;

    /**
     * VpcName 子网所属VPC的名称。
     */
    public ?string $vpcName = null;

    /**
     * UsageIpv4Count 子网已使用IPv4数量。
     */
    public ?int $usageIpv4Count = null;

    /**
     * UsageIpv6Count 子网已使用IPv6数量。
     */
    public ?int $usageIpv6Count = null;

    /**
     * CreateTime 子网的创建时间。
     */
    public ?string $createTime = null;

    /**
     * IsDefault 子网是否为默认。
     */
    public ?bool $isDefault = null;

    /**
     * DhcpOptionsSetId DHCP选项集ID。
     */
    public ?string $dhcpOptionsSetId = null;

    /**
     * Ipv6MaskLength 分配给网卡的IPv6掩码长度。
     * 如果子网的IP堆栈类型不包括V6,该字段取不到值。
     */
    public ?int $ipv6MaskLength = null;
}
