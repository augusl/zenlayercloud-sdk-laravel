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
 * AssignNetworkInterfaceIpv4Request
 */
class AssignNetworkInterfaceIpv4Request extends AbstractModel
{
    /**
     * NicId 需要绑定的网卡ID。
     */
    public ?string $nicId = null;

    /**
     * IpAddress 绑定的内网IP地址。
     * 该地址必须属于子网的CIDR内，且未被使用。
     */
    public ?string $ipAddress = null;
}
