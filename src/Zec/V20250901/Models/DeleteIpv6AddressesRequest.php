<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteIpv6AddressesRequest extends AbstractModel
{
    /**
     * Ipv6Ids 要删除的公网 IPv6 的 ID 列表。
     *
     * @var list<string>|null
     */
    public ?array $ipv6Ids = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'ipv6Ids' => 'string',
    ];
}
