<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateRouteResponseParams
 */
class CreateRouteResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * RouteId 创建的路由ID。
     */
    public ?string $routeId = null;
}
