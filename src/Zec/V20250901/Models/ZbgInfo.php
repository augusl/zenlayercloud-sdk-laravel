<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ZbgInfo 描述边界网关的基本信息。
 */
class ZbgInfo extends AbstractModel
{
    /**
     * ZbgId 边界网关ID。
     */
    public ?string $zbgId = null;

    /**
     * Name 边界网关名称。
     */
    public ?string $name = null;

    /**
     * VpcId VPC的ID。
     */
    public ?string $vpcId = null;

    /**
     * RegionId 节点的ID。
     */
    public ?string $regionId = null;

    /**
     * Asn ASN号。
     */
    public ?int $asn = null;

    /**
     * InterConnectCidr 互联IP地址段。
     */
    public ?string $interConnectCidr = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * CloudRouterIds 关联的三层网络ID集合。
     */
    public ?array $cloudRouterIds = null;

    /**
     * RoutingMode 路由模式。
     */
    public ?string $routingMode = null;

    /**
     * NatId NAT的ID。
     */
    public ?string $natId = null;

    /**
     * AdvertisedSubnet 子网控制。
     */
    public ?string $advertisedSubnet = null;

    /**
     * AdvertisedCidrs IPv4 Cidr集合。
     */
    public ?array $advertisedCidrs = null;

    /**
     * AdvertisedRouteIds 自定义路由集合。
     */
    public ?array $advertisedRouteIds = null;
}
