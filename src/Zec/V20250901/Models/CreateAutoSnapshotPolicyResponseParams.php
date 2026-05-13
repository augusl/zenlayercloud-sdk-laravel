<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateAutoSnapshotPolicyResponseParams
 */
class CreateAutoSnapshotPolicyResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * AutoSnapshotPolicyId 自动快照策略的ID。
     */
    public ?string $autoSnapshotPolicyId = null;
}
