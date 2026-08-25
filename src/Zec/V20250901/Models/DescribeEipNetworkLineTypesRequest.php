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
 * DescribeEipNetworkLineTypesRequest
 */
class DescribeEipNetworkLineTypesRequest extends AbstractModel
{
    /**
     * RegionId 节点ID。
     * 不传则返回所有节点支持的线路类型。
     */
    public ?string $regionId = null;
}
