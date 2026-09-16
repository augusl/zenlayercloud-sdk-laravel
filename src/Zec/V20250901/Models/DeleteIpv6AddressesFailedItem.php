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
 * DeleteIpv6AddressesFailedItem 批量删除公网IPv6中单个失败项的详情。
 */
class DeleteIpv6AddressesFailedItem extends AbstractModel
{
    /**
     * Ipv6Id 删除失败的公网IPv6的ID。
     */
    public ?string $ipv6Id = null;

    /**
     * ErrorCode 错误码。
     */
    public ?string $errorCode = null;

    /**
     * ErrorMsg 错误消息。
     */
    public ?string $errorMsg = null;
}
