<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * UnassignBorderGatewayRouteRequest
 */
class UnassignBorderGatewayRouteRequest extends AbstractModel
{
    /**
     * ZbgId 边界网关ID。
     */
    public ?string $zbgId = null;

    /**
     * AdvertisedRouteIds 要移除的自定义路由ID集合。
     */
    public ?array $advertisedRouteIds = null;
}
