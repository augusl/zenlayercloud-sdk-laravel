<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteSnapshotsRequest extends AbstractModel
{
    /**
     * SnapshotIds 快照ID列表。
     */
    public ?array $snapshotIds = null;
}
