<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteAutoSnapshotPoliciesRequest extends AbstractModel
{
    /**
     * AutoSnapshotPolicyIds 要删除的自动快照策略ID列表。
     */
    public ?array $autoSnapshotPolicyIds = null;
}
