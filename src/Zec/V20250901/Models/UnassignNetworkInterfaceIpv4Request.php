<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class UnassignNetworkInterfaceIpv4Request extends AbstractModel
{
    /**
     * NicId 网卡ID。
     */
    public ?string $nicId = null;

    /**
     * Deprecated: IpAddress 已废弃，请不要使用。
     * IpAddress 需要解绑的IPv4地址。
     * 该字段已过时，请使用`ipAddresses`，如果两者均指定， 则以`ipAddresses`为准。
     *
     * @deprecated
     */
    public ?string $ipAddress = null;

    /**
     * IpAddresses 需要解绑的内网IPv4地址。
     *
     * @var list<string>|null
     */
    public ?array $ipAddresses = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'ipAddresses' => 'string',
    ];
}
