<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class BatchAssignNetworkInterfaceIpv4Request extends AbstractModel
{
    /**
     * NicId 要操作的网卡ID。
     */
    public ?string $nicId = null;

    /**
     * IpAddresses 内网IP地址列表。
     * IP地址必须在网卡所属子网CIDR范围内，且不能是网关/广播/网络地址。
     *
     * @var list<string>|null
     */
    public ?array $ipAddresses = null;

    /**
     * IpAddressCount 指定额外绑定的内网IP数量。
     * 该字段和`ipAddresses`必须指定其一，如果都指定，则会以 `ipAddresses` 有效。
     */
    public ?int $ipAddressCount = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'ipAddresses' => 'string',
    ];
}
