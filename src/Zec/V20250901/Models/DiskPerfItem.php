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
 * DiskPerfItem 云硬盘性能信息。
 */
class DiskPerfItem extends AbstractModel
{
    /**
     * MaxIops 未开启突发时的最大 IOPS。
     */
    public ?int $maxIops = null;

    /**
     * MaxBandwidth 未开启突发时的最大带宽，单位：MB/s。
     */
    public ?int $maxBandwidth = null;

    /**
     * IopsBurst 开启突发后的 IOPS。
     */
    public ?int $iopsBurst = null;

    /**
     * BandwidthBurst 开启突发后的带宽，单位：MB/s。
     */
    public ?int $bandwidthBurst = null;
}
