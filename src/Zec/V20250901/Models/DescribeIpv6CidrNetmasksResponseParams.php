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
 * DescribeIpv6CidrNetmasksResponseParams
 */
class DescribeIpv6CidrNetmasksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * NetmaskSet 该节点当前可售的掩码档位列表，按掩码升序排列。
     * 库存为0或未配置售卖价格的掩码不会返回。
     *
     * @var list<Ipv6CidrNetmaskInfo>|null
     */
    public ?array $netmaskSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'netmaskSet' => Ipv6CidrNetmaskInfo::class,
    ];
}
