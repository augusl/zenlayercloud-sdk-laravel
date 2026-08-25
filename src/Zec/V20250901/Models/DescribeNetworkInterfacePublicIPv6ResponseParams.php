<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeNetworkInterfacePublicIPv6ResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Address 公网IPv6信息。
     * 网卡如果没有公网IPv6,则取值为空。
     */
    public ?PublicIpv6CidrAddress $address = null;
}
