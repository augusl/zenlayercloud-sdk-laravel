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
 * DescribeRegionsResponseParams
 */
class DescribeRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RegionSet 节点列表。
     *
     * @var list<RegionItem>|null
     */
    public ?array $regionSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regionSet' => RegionItem::class,
    ];
}
