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
 * DhcpOptionsSet 描述DHCP选项集的信息。
 */
class DhcpOptionsSet extends AbstractModel
{
    /**
     * DhcpOptionsSetId DHCP 选项集ID。
     */
    public ?string $dhcpOptionsSetId = null;

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
     */
    public ?string $leaseTime = null;

    /**
     * Ipv6LeaseTime IPv6 DHCP 选项集的租赁时间。
     * 单位：h。
     */
    public ?string $ipv6LeaseTime = null;

    /**
     * CreateTime 创建时间。
     * 按照ISO8601标准表示，并且使用UTC时间, 格式为：YYYY-MM-ddTHH:mm:ssZ。
     */
    public ?string $createTime = null;

    /**
     * Description DHCP选项集 描述信息。
     */
    public ?string $description = null;

    /**
     * ResourceGroupId 实例所属的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 实例所属的资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * Tags 实例关联的标签。
     */
    public ?Tags $tags = null;
}
