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
     * 可通过调用 **DescribeRegions** 获取。
     */
    public ?string $regionId = null;

    /**
     * VpcId VPC ID。
     * 可通过调用 **DescribeVpcs** 获取。
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
     * AdvertisedSubnetIds 要宣告的子网ID集合。
     * 仅当`advertisedSubnet`取值为`PART`时该字段生效。
     * 可通过调用 **DescribeSubnets** 获取。
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

    /**
     * InterConnectCidr 互联IP网段。
     * 仅支持169.254.x.x/27，留空则自动分配。
     */
    public ?string $interConnectCidr = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'advertisedSubnetIds' => 'string',
        'advertisedCidrs' => 'string',
        'advertisedRouteIds' => 'string',
    ];
}
