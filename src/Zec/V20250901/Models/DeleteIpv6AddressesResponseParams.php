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
 * DeleteIpv6AddressesResponseParams
 */
class DeleteIpv6AddressesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedIpv6Addresses 删除失败的公网IPv6详情列表。
     * 若全量成功则为空。
     *
     * @var list<DeleteIpv6AddressesFailedItem>|null
     */
    public ?array $failedIpv6Addresses = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'failedIpv6Addresses' => DeleteIpv6AddressesFailedItem::class,
    ];
}
