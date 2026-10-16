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
 * ModifyCrossRegionBandwidthRequest
 */
class ModifyCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * CrossRegionBandwidthId 要调整的VPC跨区域带宽ID。
     * 可通过调用 ~~DescribeCrossRegionBandwidth~~ 获取。
     */
    public ?string $crossRegionBandwidthId = null;

    /**
     * Bandwidth 带宽|保底带宽。
     * 单位：Mbps。
     * 计费类型为`ByBandwidth`时必须与原带宽不同；计费类型为`ByInstanceBandwidth95`时，本参数与`bandwidthCap`至少修改其中之一。
     */
    public ?int $bandwidth = null;

    /**
     * BandwidthCap 突发带宽。
     * 单位：Mbps。
     * 仅计费类型为`ByInstanceBandwidth95`时有效，不指定时保持不变。
     */
    public ?int $bandwidthCap = null;
}
