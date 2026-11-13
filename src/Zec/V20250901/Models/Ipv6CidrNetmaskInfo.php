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
 * Ipv6CidrNetmaskInfo IPv6 CIDR某个掩码档位的可售信息。
 */
class Ipv6CidrNetmaskInfo extends AbstractModel
{
    /**
     * Netmask 掩码大小。
     */
    public ?int $netmask = null;

    /**
     * NetworkLineTypes 该掩码下各条线路的库存与单价，按线路枚举顺序排列。
     * 库存为0或未配置售卖价格的线路不会返回。
     *
     * @var list<Ipv6CidrLineTypeInfo>|null
     */
    public ?array $networkLineTypes = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'networkLineTypes' => Ipv6CidrLineTypeInfo::class,
    ];
}
