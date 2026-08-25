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
 * DescribeDiskCategoryRequest
 */
class DescribeDiskCategoryRequest extends AbstractModel
{
    /**
     * ZoneId 根据可用区ID筛选。
     */
    public ?string $zoneId = null;

    /**
     * DiskCategory 根据云硬盘种类筛选。
     * Basic NVMe SSD: 经济型 NVMe SSD。
     * Standard NVMe SSD: 标准型 NVMe SSD。
     * 默认为Standard NVMe SSD。
     */
    public ?string $diskCategory = null;
}
