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
 * SystemDisk 描述系统盘的基本信息。
 */
class SystemDisk extends AbstractModel
{
    /**
     * DiskId 系统盘ID。
     * 该参数目前仅用于`DescribeInstances`等查询类接口的返回参数，不可用于`CreateInstances`等写接口的入参。
     */
    public ?string $diskId = null;

    /**
     * DiskSize 系统盘大小。
     * 单位：GiB。
     */
    public ?int $diskSize = null;

    /**
     * DiskCategory 云硬盘种类。
     * Basic NVMe SSD: 经济型 NVMe SSD。
     * Standard NVMe SSD: 标准型 NVMe SSD。
     * 默认为Standard NVMe SSD。
     */
    public ?string $diskCategory = null;

    /**
     * BurstingEnabled 是否开启性能突发。
     */
    public ?bool $burstingEnabled = null;
}
