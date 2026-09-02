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
 * CrossRegionBandwidthMetricValue 描述内网跨区域带宽的监控指标数据。
 */
class CrossRegionBandwidthMetricValue extends AbstractModel
{
    /**
     * Time 数据点时间。
     */
    public ?string $time = null;

    /**
     * InValue 入方向值。
     */
    public ?float $inValue = null;

    /**
     * LoseInValue 入方向丢弃值。
     */
    public ?float $loseInValue = null;

    /**
     * OutValue 出方向值。
     */
    public ?float $outValue = null;

    /**
     * LoseOutValue 出方向丢弃值。
     */
    public ?float $loseOutValue = null;
}
