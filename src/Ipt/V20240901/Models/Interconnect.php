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
 * Interconnect 互联地址配置。
 */
class Interconnect extends AbstractModel
{
    /**
     * VendorIpv4Address Zenlayer 侧 IPv4 互联地址。
     */
    public ?string $vendorIpv4Address = null;

    /**
     * CustomerIpv4Address 客户侧 IPv4 互联地址。
     */
    public ?string $customerIpv4Address = null;

    /**
     * VendorIpv6Address Zenlayer 侧 IPv6 互联地址。
     */
    public ?string $vendorIpv6Address = null;

    /**
     * CustomerIpv6Address 客户侧 IPv6 互联地址。
     */
    public ?string $customerIpv6Address = null;
}
