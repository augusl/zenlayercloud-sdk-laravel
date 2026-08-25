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
 * CreateBorderGatewayRequest
 */
class CreateBorderGatewayRequest extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * VpcId VPC ID。
     */
    public ?string $vpcId = null;

    /**
     * Label 名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $label = null;

    /**
     * Asn ASN号。
     */
    public ?int $asn = null;

    /**
     * RoutingMode 路由级别。
     */
    public ?string $routingMode = null;

    /**
     * AdvertisedSubnet 子网宣告控制。
     */
    public ?string $advertisedSubnet = null;

    /**
     * AdvertisedSubnetIds 子网ID集合。
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
     * AdvertisedRouteIds 自定义路由ID集合。
     *
     * @var list<string>|null
     */
    public ?array $advertisedRouteIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'advertisedSubnetIds' => 'string',
        'advertisedCidrs' => 'string',
        'advertisedRouteIds' => 'string',
    ];
}
