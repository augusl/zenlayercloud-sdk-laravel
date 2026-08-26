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
 * DescribeIPTransitAvailableCidrBlocksResponseParams
 */
class DescribeIPTransitAvailableCidrBlocksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Ipv4CidrBlocks 可用 IPv4 CIDR 块列表。
     *
     * @var list<CidrBlock>|null
     */
    public ?array $ipv4CidrBlocks = null;

    /**
     * Ipv6CidrBlocks 可用 IPv6 CIDR 块列表。
     *
     * @var list<CidrBlock>|null
     */
    public ?array $ipv6CidrBlocks = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'ipv4CidrBlocks' => CidrBlock::class,
        'ipv6CidrBlocks' => CidrBlock::class,
    ];
}
