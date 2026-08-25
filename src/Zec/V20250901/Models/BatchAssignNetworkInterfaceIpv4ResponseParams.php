<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class BatchAssignNetworkInterfaceIpv4ResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * IpAddresses 绑定的内网IP地址。
     *
     * @var list<string>|null
     */
    public ?array $ipAddresses = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'ipAddresses' => 'string',
    ];
}
