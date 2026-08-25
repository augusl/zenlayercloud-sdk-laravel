<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateDhcpOptionsSetRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetName DHCP 选项集的名称。
     * 长度为1～64个字符。
     */
    public ?string $dhcpOptionsSetName = null;

    /**
     * DomainNameServers DNS 服务器 IP。
     * 最多传入 4 个 DNS 服务器 Ipv4，DNS 服务器 IP 之间用半角逗号（,）隔开。
     */
    public ?string $domainNameServers = null;

    /**
     * Ipv6DomainNameServers DNS 服务器 IP。
     * 最多传入 4 个 DNS 服务器 Ipv6，DNS 服务器 IP 之间用半角逗号（,）隔开。
     */
    public ?string $ipv6DomainNameServers = null;

    /**
     * LeaseTime IPv4 DHCP 选项集的租赁时间。
     * 单位：h。
     * 取值范围：**24~1176**，**87600~175200**。
     */
    public ?string $leaseTime = null;

    /**
     * Ipv6LeaseTime IPv6 DHCP 选项集的租赁时间。
     * 单位：h。
     * 取值范围：**24~1176**，**87600~175200**。
     */
    public ?string $ipv6LeaseTime = null;

    /**
     * Tags 创建DHCP 选项集时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /**
     * ResourceGroupId 资源组ID。
     * 如果不指定，则会创建在默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * Description DHCP选项集 描述信息。
     * 最长不超过255个字符。
     */
    public ?string $description = null;
}
