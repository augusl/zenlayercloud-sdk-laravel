<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateSnapshotRequest
 */
class CreateSnapshotRequest extends AbstractModel
{
    /**
     * DiskId 云硬盘ID。
     */
    public ?string $diskId = null;

    /**
     * SnapshotName 快照名称。
     */
    public ?string $snapshotName = null;

    /**
     * RetentionTime 保留的到期时间。
     * 格式为：yyyy-MM-ddTHH:mm:ssZ。
     * 如果不传，则代表永久保留。
     * 指定时间必须在当前时间24小时后。
     */
    public ?string $retentionTime = null;
}
