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
 * ModifyDhcpOptionsSetAttributesRequest
 */
class ModifyDhcpOptionsSetAttributesRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetId DHCP选项集ID。
     * 可通过调用 ~~DescribeDhcpOptionsSets~~ 获取。
     */
    public ?string $dhcpOptionsSetId = null;

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
     * Description DHCP选项集 描述信息。
     * 最长不超过255个字符。
     */
    public ?string $description = null;
}
