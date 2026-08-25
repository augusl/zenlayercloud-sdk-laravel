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
 * PoolInfo 描述公网IP池的基本信息。
 */
class PoolInfo extends AbstractModel
{
    /**
     * PoolId 公网IP池的ID。
     */
    public ?string $poolId = null;

    /**
     * RegionId 公网IP池所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * Name 公网IP池的名称。
     */
    public ?string $name = null;

    /**
     * CreateTime 公网IP池的创建时间。
     */
    public ?string $createTime = null;

    /**
     * Ipv4CidrCount CIDR IPv4的数量。
     */
    public ?int $ipv4CidrCount = null;

    /**
     * Ipv6CidrCount CIDR IPv6的数量。
     */
    public ?int $ipv6CidrCount = null;
}
