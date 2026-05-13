<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyDhcpOptionsSetAttributesRequest extends AbstractModel
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
     * Description DHCP选项集 描述信息。
     * 最长不超过255个字符。
     */
    public ?string $description = null;
}
