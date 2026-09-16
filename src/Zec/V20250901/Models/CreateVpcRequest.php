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
 * CreateVpcRequest
 */
class CreateVpcRequest extends AbstractModel
{
    /**
     * Name VPC的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /**
     * CidrBlock VPC的CIDR地址段，该VPC下所有子网必须落在此网段内。
     * 掩码范围为9到29，且必须填写网段的起始地址，例如 `10.0.0.0/16`。
     * 支持配置多个网段，多个网段之间以英文逗号分隔，例如：`21.0.0.0/9,22.0.0.0/9`，各网段之间不能重叠。
     * 单个VPC的网段数量上限由配额 `ZEC_CIDR_IPv4_Blocks_per_VPC` 控制，默认为5个，可申请提升。
     * 不能与以下保留网段重叠：`0.0.0.0/8`、`100.64.0.0/10`、`127.0.0.0/8`、`169.254.0.0/16`、`224.0.0.0/4`。
     */
    public ?string $cidrBlock = null;

    /**
     * Mtu VPC的MTU（最大传输单元）。支持：1300、1500、9000。
     */
    public ?int $mtu = null;

    /**
     * EnablePriIpv6 是否开启内网IPv6。
     * 一旦开启，后续无法关闭。
     * 默认为关闭。
     */
    public ?bool $enablePriIpv6 = null;

    /**
     * ResourceGroupId VPC所在的资源组ID。
     * 如果不指定资源组，则会放到默认的资源组中。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建VPC时关联的标签。同一资源中标签键不能重复。
     */
    public ?TagAssociation $tags = null;
}
