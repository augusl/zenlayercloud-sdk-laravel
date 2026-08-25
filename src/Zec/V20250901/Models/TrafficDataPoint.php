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
 * TrafficDataPoint 流量监控数据点。
 */
class TrafficDataPoint extends AbstractModel
{
    /**
     * Timestamp 数据点时间。
     * 时间格式：yyyy-MM-ddTHH:mm:ssZ。
     */
    public ?string $timestamp = null;

    /**
     * BandwidthIn 入向带宽，单位bps。
     */
    public ?int $bandwidthIn = null;

    /**
     * BandwidthOut 出向带宽，单位bps。
     */
    public ?int $bandwidthOut = null;
}
