<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class AssignBorderGatewayRouteRequest extends AbstractModel
{
    /**
     * ZbgId 边界网关ID。
     */
    public ?string $zbgId = null;

    /**
     * AdvertisedRouteIds 自定义路由ID集合。
     */
    public ?array $advertisedRouteIds = null;
}
