<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteSnapshotsResponseParams
 */
class DeleteSnapshotsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SnapshotIds 操作失败的快照ID。
     */
    public ?array $snapshotIds = null;
}
