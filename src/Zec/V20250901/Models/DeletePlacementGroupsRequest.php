<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeletePlacementGroupsRequest
 */
class DeletePlacementGroupsRequest extends AbstractModel
{
    /**
     * PlacementGroupIds 要删除的置放组ID列表。
     */
    public ?array $placementGroupIds = null;
}
