<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeletePlacementGroupsResponseParams
 */
class DeletePlacementGroupsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * FailedPlacementGroupIds 删除失败的置放组ID列表。
     * 若全量成功则为空。
     */
    public ?array $failedPlacementGroupIds = null;
}
