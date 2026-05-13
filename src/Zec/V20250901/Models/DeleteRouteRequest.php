<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteRouteRequest
 */
class DeleteRouteRequest extends AbstractModel
{
    /**
     * RouteId 路由ID。
     */
    public ?string $routeId = null;
}
