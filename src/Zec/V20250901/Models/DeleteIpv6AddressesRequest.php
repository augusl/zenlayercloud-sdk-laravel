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
 * DeleteIpv6AddressesRequest
 */
class DeleteIpv6AddressesRequest extends AbstractModel
{
    /**
     * Ipv6Ids 要删除的公网IPv6的ID列表。
     * 可通过调用 ~~DescribeIpv6Addresses~~ 获取。
     *
     * @var list<string>|null
     */
    public ?array $ipv6Ids = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'ipv6Ids' => 'string',
    ];
}
