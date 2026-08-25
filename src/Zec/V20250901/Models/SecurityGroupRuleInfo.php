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
 * SecurityGroupRuleInfo 安全组规则信息。包括出入方向、端口范围、IP协议等信息。
 */
class SecurityGroupRuleInfo extends AbstractModel
{
    /**
     * Direction 规则方向。
     * ingress: 入方向。
     * egress：出方向。
     */
    public ?string $direction = null;

    /**
     * Policy 设置访问权限。
     * accept：接受访问。
     * deny: 拒绝访问。
     */
    public ?string $policy = null;

    /**
     * Priority 规则优先级。
     */
    public ?int $priority = null;

    /**
     * IpProtocol 传输层协议。
     * 取值大小写敏感, 取值范围：<br/>tcp：TCP协议。
     * udp：UDP协议。
     * icmp：ICMP协议。
     * all：支持所有协议。
     */
    public ?string $ipProtocol = null;

    /**
     * PortRange 目的端安全组开放的传输层协议相关的端口范围。
     * 取值范围：<br/> TCP/UDP协议：取值范围为1~65535。
     * ICMP协议：-1。
     * all：-1。
     */
    public ?string $portRange = null;

    /**
     * CidrIp 源端IP地址范围。
     * 支持CIDR格式和IPv4格式的IP地址范围。
     * 默认值：0.0.XX.XX/0。
     */
    public ?string $cidrIp = null;

    /**
     * Desc 备注,长度在255个以内。
     */
    public ?string $desc = null;
}
