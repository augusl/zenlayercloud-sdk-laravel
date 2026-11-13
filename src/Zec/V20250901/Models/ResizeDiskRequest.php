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
 * ResizeDiskRequest
 */
class ResizeDiskRequest extends AbstractModel
{
    /**
     * DiskId 云硬盘ID。
     * 通过 **DescribeDisks** 接口查询。
     */
    public ?string $diskId = null;

    /**
     * DiskSize 云硬盘扩容后的大小。
     * 单位GiB。
     * 必须大于当前云硬盘大小，不支持缩容。
     */
    public ?int $diskSize = null;
}
