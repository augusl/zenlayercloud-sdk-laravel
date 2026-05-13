<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreatePlacementGroupResponseParams
 */
class CreatePlacementGroupResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * PlacementGroupId 创建成功的置放组ID。
     */
    public ?string $placementGroupId = null;
}
