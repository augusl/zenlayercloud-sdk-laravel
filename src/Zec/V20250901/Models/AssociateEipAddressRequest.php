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
     */
    public ?string $loadBalancerId = null;

    /**
     * NicId 虚拟网卡的ID。
     */
    public ?string $nicId = null;

    /**
     * LanIp 要绑定的网卡上的内网IP地址。
     * 当IP绑定的是网卡, 则该字段不能为空。
     */
    public ?string $lanIp = null;

    /**
     * NatId NAT网关的ID。
     */
    public ?string $natId = null;

    /**
     * EipIds 要绑定的EIP的ID。
     * EIP 必须是未绑定状态。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * HaVipId 高可用虚拟IP的ID。
     */
    public ?string $haVipId = null;

    /**
     * BindType 绑定类型。
     * 当绑定的是网卡时生效。
     * 默认为普通NAT模式。
     */
    public ?string $bindType = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'eipIds' => 'string',
    ];
}
