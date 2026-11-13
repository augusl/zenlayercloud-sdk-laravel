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
 * CreateIpv6CidrRequest
 */
class CreateIpv6CidrRequest extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * NetworkLineType 公网IPv6的网络类型。
     * 支持的线路以`DescribeIpv6CidrNetmasks`的返回为准。
     */
    public ?string $networkLineType = null;

    /**
     * Netmask 要购买的CIDR掩码与数量。
     * 需要购买不同掩码的CIDR时请分多次调用。
     */
    public ?Ipv6NetmaskInfo $netmask = null;

    /**
     * SubnetMaskLength 该CIDR拆分成子网时使用的掩码长度。
     * 取值范围为`[掩码, 掩码+8]`。
     */
    public ?int $subnetMaskLength = null;

    /**
     * Name CIDR名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     * 默认会将分配的CIDR地址作为名称。
     */
    public ?string $name = null;

    /**
     * ResourceGroupId 资源组ID。
     * 如果不指定，则会加入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * InstanceChargePostpaid 后付费的承诺期设置。
     * 仅支持账号已开通的承诺期时长。
     */
    public ?ChargePostpaid $instanceChargePostpaid = null;

    /**
     * MarketingOptions 市场营销相关的选项。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 创建CIDR时关联的标签。
     * 注意：关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;
}
