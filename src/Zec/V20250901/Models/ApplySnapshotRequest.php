<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ApplySnapshotRequest extends AbstractModel
{
    /**
     * SnapshotId 快照唯一ID。
     */
    public ?string $snapshotId = null;

    /**
     * DiskId 云硬盘ID。
     */
    public ?string $diskId = null;
}
