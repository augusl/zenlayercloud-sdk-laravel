<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * SystemDisk 描述系统盘的基本信息。
 */
class SystemDisk extends AbstractModel
{
    /**
     * DiskId 磁盘ID。
     */
    public ?string $diskId = null;

    /**
     * DiskSize 系统盘大小，单位GB。
     */
    public ?int $diskSize = null;

    /**
     * DiskCategory 磁盘种类。
     * STANDARD：标准云盘。
     * SSD：固态硬盘。
     * 默认为SSD。
     */
    public ?string $diskCategory = null;
}
