<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * IPTransitDatacenter 可连接数据中心信息。
 */
class IPTransitDatacenter extends AbstractModel
{
    /**
     * DataCenter 数据中心信息。
     */
    public ?DatacenterInfo $dataCenter = null;

    /**
     * AvailableRoutingTypes 该数据中心可用的路由模式列表。
     *
     * @var list<RemoteIptAvailableRoutingType>|null
     */
    public ?array $availableRoutingTypes = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'availableRoutingTypes' => RemoteIptAvailableRoutingType::class,
    ];
}
