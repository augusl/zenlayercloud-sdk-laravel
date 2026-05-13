<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateSubnetRequest
 */
class CreateSubnetRequest extends AbstractModel
{
    /**
     * VpcId 需要添加子网的VPC ID。
     */
    public ?string $vpcId = null;

    /**
     * Name 子网名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /**
     * RegionId 子网所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * StackType 子网的IP堆栈类型。
     */
    public ?string $stackType = null;

    /**
     * CidrBlock 子网的IPv4 CIDR地址段。
     * 如果指定堆栈类型`stackType` 包含 `IPv4`, 则该字段必填。
     * 指定的CIDR地址段必须属于VPC的CIDR范围内。
     */
    public ?string $cidrBlock = null;

    /**
     * Ipv6Type IPv6的类型。
     * 如果指定堆栈类型`stackType` 包含 `IPv6`, 则该字段必填。
     */
    public ?string $ipv6Type = null;

    /**
     * DhcpOptionsSetId 要绑定的DHCP 选项集ID。
     */
    public ?string $dhcpOptionsSetId = null;

    /**
     * Ipv6CidrBlockId 公网IPv6 CIDR ID。
     * 该字段仅当`ipv6Type`是公网(`Public`)时允许指定。
     * 如果不指定，将从系统默认IP池里分配。
     */
    public ?string $ipv6CidrBlockId = null;

    /**
     * Ipv6MaskLength 分配给虚拟机（VM）的IPv6 CIDR前缀的大小。
     * 该参数必须与`ipv6CidrBlockId`参数配合使用。
     * 当未显式传递时，默认值为96。
     * 最小必须大于或等于指定`ipv6CidrBlockId`的前缀，最大不能超过96。
     */
    public ?int $ipv6MaskLength = null;
}
