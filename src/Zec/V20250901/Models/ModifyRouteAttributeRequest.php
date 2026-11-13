<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

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
     * 可通过调用 **DescribeRoutes** 获取。
     */
    public ?string $routeId = null;

    /**
     * Name 路由名称。
     * 名称长度为2到63个字符，仅支持字母、数字、连字符（-）、下划线（_）、斜杠（/）和英文句点（.），且开头和结尾必须是字母或数字。
     */
    public ?string $name = null;
}
