<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyRouteAttributeRequest
 */
class ModifyRouteAttributeRequest extends AbstractModel
{
    /**
     * RouteId 路由ID。
     */
    public ?string $routeId = null;

    /**
     * Name 路由名称。
     * 名称长度为 2 到 63 个字符，仅支持字母、数字、连字符 (-) 、下划线(_) 、斜杠(/) 、和句点 (.)，且开头和结尾必须是字母或数字。
     */
    public ?string $name = null;
}
