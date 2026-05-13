<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateSnapshotResponseParams
 */
class CreateSnapshotResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SnapshotId 创建的快照ID。
     */
    public ?string $snapshotId = null;
}
