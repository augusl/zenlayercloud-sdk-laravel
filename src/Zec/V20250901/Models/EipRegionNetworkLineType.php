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
 * EipRegionNetworkLineType 节点与其支持的IP线路类型映射。
 */
class EipRegionNetworkLineType extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * NetworkLineTypes 该节点支持的IP线路类型列表。
     *
     * @var list<string>|null
     */
    public ?array $networkLineTypes = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'networkLineTypes' => 'string',
    ];
}
