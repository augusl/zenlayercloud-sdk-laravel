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
 * ModifyVpcAttributeRequest
 */
class ModifyVpcAttributeRequest extends AbstractModel
{
    /**
     * VpcId VPC的ID。
     * 可通过调用 **DescribeVpcs** 获取。
     */
    public ?string $vpcId = null;

    /**
     * VpcName VPC的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $vpcName = null;

    /**
     * CidrBlock 需要修改的主IPv4 CIDR。
     * 本字段只修改主网段，附属网段请通过 **AssociateVpcCidrBlock** 与 **UnassociateVpcCidrBlock** 增删。
     * 掩码范围为9到29，且必须填写网段的起始地址，例如`10.0.0.0/16`。
     * 主网段只能在原网段范围内放大或缩小，即新网段必须与原主网段有重叠；换成与原主网段不相干的网段会被拒绝，主网段也不支持删除。
     * 缩小时，原本落在主网段内的子网必须仍落在新的主网段内，否则请求会被拒绝；附属网段下的子网不受影响。
     * 不能与该VPC已有的附属网段重叠，也不能与以下保留网段重叠：`0.0.0.0/8`、`100.64.0.0/10`、`127.0.0.0/8`、`169.254.0.0/16`、`224.0.0.0/4`。
     * 不传该字段表示不修改主网段。
     * 默认VPC不支持修改CIDR。
     */
    public ?string $cidrBlock = null;

    /**
     * EnableIPv6 是否开启IPv6内网CIDR。
     * 当前仅允许打开(`true`)，一旦开启将无法关闭。
     */
    public ?bool $enableIPv6 = null;

    /**
     * SecurityGroupId 修改VPC绑定的安全组ID。
     * 如果不指定，则不会修改。
     * 可通过调用 **DescribeSecurityGroups** 获取。
     */
    public ?string $securityGroupId = null;
}
