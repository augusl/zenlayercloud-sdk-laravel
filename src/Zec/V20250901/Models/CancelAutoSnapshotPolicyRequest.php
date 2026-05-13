<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CancelAutoSnapshotPolicyRequest extends AbstractModel
{
    /**
     * AutoSnapshotPolicyId 自动快照策略ID。
     */
    public ?string $autoSnapshotPolicyId = null;

    /**
     * DiskIds 要移除的磁盘ID列表。
     */
    public ?array $diskIds = null;
}
