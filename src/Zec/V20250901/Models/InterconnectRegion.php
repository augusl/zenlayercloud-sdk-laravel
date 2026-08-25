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
 * InterconnectRegion 边界网关互联节点信息。
 */
class InterconnectRegion extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * Name 节点名称。
     */
    public ?string $name = null;

    /**
     * DataCenter 关联的数据中心信息。
     */
    public ?InterconnectDataCenter $dataCenter = null;
}
