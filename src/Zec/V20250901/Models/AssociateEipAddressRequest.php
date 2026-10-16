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
 * AssociateEipAddressRequest
 */
class AssociateEipAddressRequest extends AbstractModel
{
    /**
     * LoadBalancerId 负载均衡实例的ID。
     * 仅`ipStackType`为`IPv4`的负载均衡可绑定弹性IP——负载均衡只支持单栈，`IPv6`的公网地址通过 ~~zlb:AssignLoadBalancerIpv6~~ 接口分配。
     */
    public ?string $loadBalancerId = null;

    /**
     * NicId 虚拟网卡的ID。
     * 可通过调用 ~~DescribeNetworkInterfaces~~ 获取。
     */
    public ?string $nicId = null;

    /**
     * LanIp 要绑定的网卡上的内网IP地址。
     * 当EIP绑定的是网卡时，该字段不能为空。
     */
    public ?string $lanIp = null;

    /**
     * NatId NAT网关的ID。
     * 可通过调用 ~~DescribeNatGateways~~ 获取。
     */
    public ?string $natId = null;

    /**
     * EipIds 要绑定的EIP的ID。
     * EIP必须是未绑定状态。
     * 可通过调用 ~~DescribeEips~~ 获取。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * HaVipId 高可用虚拟IP的ID。
     * 可通过调用 ~~DescribeHaVips~~ 获取。
     */
    public ?string $haVipId = null;

    /**
     * BindType 绑定类型。
     * 当绑定的是网卡时生效。
     */
    public ?string $bindType = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'eipIds' => 'string',
    ];
}
