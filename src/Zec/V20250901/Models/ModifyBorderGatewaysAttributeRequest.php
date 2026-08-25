<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyBorderGatewaysAttributeRequest extends AbstractModel
{
    /**
     * ZbgIds 边界网关的ID列表。
     *
     * @var list<string>|null
     */
    public ?array $zbgIds = null;

    /**
     * Name 边界网关的名称。
     */
    public ?string $name = null;

    /**
     * RoutingMode 路由级别。
     */
    public ?string $routingMode = null;

    /**
     * AdvertisedSubnet 子网控制。
     */
    public ?string $advertisedSubnet = null;

    /**
     * AdvertisedSubnetIds Subnet子网ID集合。
     * 若要该字段生效,需将该字段(`advertisedSubnet`)值设置为PART。
     *
     * @var list<string>|null
     */
    public ?array $advertisedSubnetIds = null;

    /**
     * AdvertisedCidrs IPv4 Cidr集合。
     *
     * @var list<string>|null
     */
    public ?array $advertisedCidrs = null;

    /**
     * Asn 边界网关的ASN。
     */
    public ?int $asn = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'zbgIds' => 'string',
        'advertisedSubnetIds' => 'string',
        'advertisedCidrs' => 'string',
    ];
}
