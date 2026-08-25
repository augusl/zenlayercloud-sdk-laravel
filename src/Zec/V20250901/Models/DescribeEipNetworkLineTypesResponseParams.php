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
 * DescribeEipNetworkLineTypesResponseParams
 */
class DescribeEipNetworkLineTypesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RegionNetworkLineTypes 各节点支持的IP线路类型列表。
     *
     * @var list<EipRegionNetworkLineType>|null
     */
    public ?array $regionNetworkLineTypes = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regionNetworkLineTypes' => EipRegionNetworkLineType::class,
    ];
}
