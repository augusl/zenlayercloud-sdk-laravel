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
 * ModifyIpv6BandwidthRequest
 */
class ModifyIpv6BandwidthRequest extends AbstractModel
{
    /**
     * Ipv6Id IPv6唯一标识ID。
     * 可通过调用 ~~DescribeIpv6Addresses~~ 获取。
     */
    public ?string $ipv6Id = null;

    /**
     * Bandwidth 调整带宽限速的目标值。
     * 单位Mbps。
     */
    public ?int $bandwidth = null;
}
