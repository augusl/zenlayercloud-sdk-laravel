<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ResizeDiskRequest extends AbstractModel
{
    /**
     * DiskId 云硬盘ID。
     */
    public ?string $diskId = null;

    /**
     * DiskSize 扩容后的云硬盘大小，单位GB。
     */
    public ?int $diskSize = null;
}
