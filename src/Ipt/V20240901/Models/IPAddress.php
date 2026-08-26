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
 * IPAddress 描述IP信息。
 */
class IPAddress extends AbstractModel
{
    /**
     * IpAddress IP地址。
     */
    public ?string $ipAddress = null;

    /**
     * Netmask 掩码。
     */
    public ?int $netmask = null;

    /**
     * GatewayIpAddress 网关IP地址。
     */
    public ?string $gatewayIpAddress = null;
}
