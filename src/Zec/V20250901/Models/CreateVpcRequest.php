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
     * CidrBlock VPC的CIDR地址段。
     * 该VPC下所有子网必须落在此网段内，请预留足够的地址空间。
     * 掩码范围为9到29。
     * 支持配置多个网段，多个网段之间以英文逗号分隔，例如：`21.0.0.0/9,22.0.0.0/9`，各网段之间不能重叠，最多支持5个网段。
     * **强烈建议使用 RFC 1918 定义的私有地址空间内的网段**：`10.0.0.0/8`、`172.16.0.0/12` 或 `192.168.0.0/16`。
     * 请注意 `10.0.0.0/8` 本身超出了VPC支持的最大网段规模，如需使用 10.x 地址空间，请指定其子网段，例如 `10.0.0.0/16`；另外两个 RFC 1918 网段可以整段使用。
     * 非 RFC 1918 网段可以被接受，但存在显著风险：将公网可路由的网段设为VPC网段后，所有发往这些地址的流量都会在VPC内被路由、不会离开VPC，该VPC下的每一台实例都将失去访问该网段上真实互联网服务的能力（包括公网端点、软件源和API）。
     * 该故障具有隐蔽性——路由表看起来完全正常，但目标地址就是不可达。
     * 此外，若该VPC后续需要与本地网络或其他网络互联，地址重叠的风险也会显著提高。
     * 与以下保留网段重叠的网段不可使用，将被拒绝：`0.0.0.0/8`（本网络）、`100.64.0.0/10`（运营商级NAT共享地址）、`127.0.0.0/8`（环回地址）、`169.254.0.0/16`（链路本地地址）、`224.0.0.0/4`（组播地址）。
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
