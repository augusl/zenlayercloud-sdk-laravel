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
 * Ipv6NetmaskInfo 描述IPv6 CIDR掩码的信息。
 */
class Ipv6NetmaskInfo extends AbstractModel
{
    /**
     * Netmask 掩码大小。
     * 各节点实际可售的掩码以`DescribeIpv6CidrNetmasks`的返回为准。
     */
    public ?int $netmask = null;

    /**
     * Amount CIDR的数量。
     */
    public ?int $amount = null;
}
