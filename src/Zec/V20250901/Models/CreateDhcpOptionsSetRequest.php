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
 * CreateDhcpOptionsSetRequest
 */
class CreateDhcpOptionsSetRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetName DHCP选项集的名称。
     * 长度为1～64个字符。
     */
    public ?string $dhcpOptionsSetName = null;

    /**
     * DomainNameServers DNS服务器IP。
     * 最多传入4个DNS服务器Ipv4，DNS服务器IP之间用半角逗号（,）隔开。
     */
    public ?string $domainNameServers = null;

    /**
     * Ipv6DomainNameServers DNS服务器IP。
     * 最多传入4个DNS服务器Ipv6，DNS服务器IP之间用半角逗号（,）隔开。
     */
    public ?string $ipv6DomainNameServers = null;

    /**
     * LeaseTime IPv4 DHCP选项集的租赁时间。
     * 单位：h。
     * 取值范围：**24~1176**，**87600~175200**。
     */
    public ?string $leaseTime = null;

    /**
     * Ipv6LeaseTime IPv6 DHCP选项集的租赁时间。
     * 单位：h。
     * 取值范围：**24~1176**，**87600~175200**。
     */
    public ?string $ipv6LeaseTime = null;

    /**
     * Tags 创建DHCP选项集时关联的标签。
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
