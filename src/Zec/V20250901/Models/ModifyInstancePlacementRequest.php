<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyInstancePlacementRequest
 */
class ModifyInstancePlacementRequest extends AbstractModel
{
    /**
     * InstanceId 实例ID。
     */
    public ?string $instanceId = null;

    /**
     * PlacementGroupId 置放组ID。
     * 为空表示从当前置放组移除。
     */
    public ?string $placementGroupId = null;
}
