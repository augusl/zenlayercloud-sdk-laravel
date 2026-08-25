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
 * DescribeInterconnectBorderGatewayRegionsRequest
 */
class DescribeInterconnectBorderGatewayRegionsRequest extends AbstractModel
{
    /**
     * RegionId 节点ID，用于过滤指定节点。
     */
    public ?string $regionId = null;

    /**
     * DcId 数据中心UUID，用于过滤指定数据中心。
     */
    public ?string $dcId = null;

    /**
     * DcCode 数据中心代码，用于过滤指定数据中心。
     */
    public ?string $dcCode = null;
}
