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
 * ApplySnapshotRequest
 */
class ApplySnapshotRequest extends AbstractModel
{
    /**
     * SnapshotId 快照唯一ID。
     * 可通过调用 ~~DescribeSnapshots~~ 获取。
     */
    public ?string $snapshotId = null;

    /**
     * DiskId 云硬盘ID。
     * 可通过调用 ~~DescribeDisks~~ 获取。
     */
    public ?string $diskId = null;
}
