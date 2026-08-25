<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RuleInfo 安全组规则信息。
 */
class RuleInfo extends AbstractModel
{
    /**
     * Direction 规则方向。
     * ingress：入方向。
     * egress：出方向。
     */
    public ?string $direction = null;

    /**
     * Policy 设置访问权限。
     * accept：接受访问。
     * 目前只支持accept。
     */
    public ?string $policy = null;

    /**
     * Priority 规则优先级。
     */
    public ?int $priority = null;

    /**
     * IpProtocol 传输层协议。
     * 取值范围：tcp、udp、icmp、all。
     */
    public ?string $ipProtocol = null;

    /**
     * PortRange 目的端安全组开放的传输层协议相关的端口范围。
     */
    public ?string $portRange = null;

    /**
     * CidrIp 源端IP地址范围。
     * 支持CIDR格式和IPv4格式的IP地址范围。
     */
    public ?string $cidrIp = null;

    /**
     * Description 规则描述。
     */
    public ?string $description = null;
}
