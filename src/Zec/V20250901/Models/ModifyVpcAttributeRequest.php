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
     * CidrBlock 需要修改的IPv4 CIDR。
     * 掩码范围为9到29，且必须填写网段的起始地址，例如 `10.0.0.0/16`。
     * 支持配置多个网段，多个网段之间以英文逗号分隔，例如：`21.0.0.0/9,22.0.0.0/9`，各网段之间不能重叠。
     * 单个VPC的网段数量上限由配额 `ZEC_CIDR_IPv4_Blocks_per_VPC` 控制，默认为5个，可申请提升。
     * 不能与以下保留网段重叠：`0.0.0.0/8`、`100.64.0.0/10`、`127.0.0.0/8`、`169.254.0.0/16`、`224.0.0.0/4`。
     * 该字段为全量覆盖：需要保留的网段也要一并传入，未传入的网段视为移除。
     * 修改后VPC下每一个子网都必须仍落在新的CIDR范围内，否则请求会被拒绝；因此没有子网的网段可以自由缩小或移除。
     * 默认VPC不支持修改CIDR。
     */
    public ?string $cidrBlock = null;

    /**
     * EnableIPv6 是否开启IPv6内网CIDR。
     * 当前仅允许打开(`true`)，一旦设置IPv6, 将无法关闭。
     */
    public ?bool $enableIPv6 = null;

    /**
     * SecurityGroupId 修改VPC绑定的安全组ID。
     * 如果不指定，则不会修改。
     */
    public ?string $securityGroupId = null;
}
