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
 * DescribeSubnetRegionsResponseParams
 */
class DescribeSubnetRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RegionSet 支持子网的节点信息。
     *
     * @var list<RegionInfo>|null
     */
    public ?array $regionSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regionSet' => RegionInfo::class,
    ];
}
