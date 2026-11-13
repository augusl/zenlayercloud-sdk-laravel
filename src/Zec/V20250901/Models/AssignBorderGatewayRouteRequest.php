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
 * AssignBorderGatewayRouteRequest
 */
class AssignBorderGatewayRouteRequest extends AbstractModel
{
    /**
     * ZbgId 边界网关ID。
     * 可通过调用 **DescribeBorderGateways** 获取。
     */
    public ?string $zbgId = null;

    /**
     * AdvertisedRouteIds 自定义路由ID集合。
     *
     * @var list<string>|null
     */
    public ?array $advertisedRouteIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'advertisedRouteIds' => 'string',
    ];
}
