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
 * RemoteIptAvailableRoutingType IP Transit可用路由模式信息。
 */
class RemoteIptAvailableRoutingType extends AbstractModel
{
    /**
     * RoutingType 路由模式。
     */
    public ?string $routingType = null;

    /**
     * AvailableBgpRouteTypes 可选的 BGP 路由通告类型列表。
     * 仅 `routingType` 为 BGP 时有值。
     *
     * @var list<string>|null
     */
    public ?array $availableBgpRouteTypes = null;

    /**
     * AvailableBgpTiers 可选的 BGP 档位列表。
     * 仅 `routingType` 为 BGP 时有值。
     *
     * @var list<string>|null
     */
    public ?array $availableBgpTiers = null;

    /**
     * PeerAsns 各 BGP 档位对应的 Zenlayer 侧（对端）AS 号，供客户本地路由器 BGP 邻居配置。
     * 仅 `routingType` 为 BGP 时有值。
     *
     * @var list<RiptPeerAsn>|null
     */
    public ?array $peerAsns = null;

    /**
     * DeliveryType 开通方式。
     */
    public ?string $deliveryType = null;

    /**
     * PublicInterconnectNetmasks IPv4 公网互联可选掩码列表。
     * 目前仅 30 / 31。
     *
     * @var list<int>|null
     */
    public ?array $publicInterconnectNetmasks = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'peerAsns' => RiptPeerAsn::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'availableBgpRouteTypes' => 'string',
        'availableBgpTiers' => 'string',
        'publicInterconnectNetmasks' => 'int',
    ];
}
