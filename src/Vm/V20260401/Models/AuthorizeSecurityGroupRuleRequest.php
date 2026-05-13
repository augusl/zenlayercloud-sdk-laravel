<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class AuthorizeSecurityGroupRuleRequest extends AbstractModel
{
    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * Direction 规则方向。
     * ingress：入方向。
     * egress：出方向。
     */
    public ?string $direction = null;

    /**
     * Policy 设置访问权限。
     * accept（默认值）：接受访问。
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
     */
    public ?string $cidrIp = null;

    /**
     * Description 规则描述。
     */
    public ?string $description = null;
}
