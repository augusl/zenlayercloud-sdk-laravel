<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CidrBlock 可用 CIDR 块信息。
 */
class CidrBlock extends AbstractModel
{
    /**
     * Netmask 掩码长度。
     * IPv4 范围 24–32，IPv6 范围 48–64。
     */
    public ?int $netmask = null;

    /**
     * IpNetworkType IP 网络类型。
     */
    public ?string $ipNetworkType = null;
}
