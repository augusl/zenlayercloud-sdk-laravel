<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * RouteInfo 描述路由的相关信息。
 */
class RouteInfo extends AbstractModel
{
    /**
     * RouteId 路由ID。
     */
    public ?string $routeId = null;

    /**
     * Name 路由的名称。
     */
    public ?string $name = null;

    /**
     * VpcId 路由关联的VPC的ID。
     */
    public ?string $vpcId = null;

    /**
     * VpcName 路由关联的VPC的名称。
     */
    public ?string $vpcName = null;

    /**
     * IpVersion IP类型。
     * 支持`IPv4`和`IPv6`两种类型。
     */
    public ?string $ipVersion = null;

    /**
     * Type 路由类型。
     */
    public ?string $type = null;

    /**
     * SourceCidrBlock 源IP地址。
     * 当`路由类型`是`RouteTypePolicy(策略路由)`时可取值。
     */
    public ?string $sourceCidrBlock = null;

    /**
     * DestinationCidrBlock IPv4或IPv6的目标网段。
     * 例如：10.0.1.0/24。
     */
    public ?string $destinationCidrBlock = null;

    /**
     * CidrBlock IPv4或IPv6的目标网段。
     * 例如：10.0.1.0/24。
     * 该字段已废弃，请使用`destinationCidrBlock`。
     */
    public ?string $cidrBlock = null;

    /**
     * Priority 路由优先级。
     */
    public ?int $priority = null;

    /**
     * NextHopId 下一跳资源ID。
     */
    public ?string $nextHopId = null;

    /**
     * NextHopName 下一跳资源名称。
     */
    public ?string $nextHopName = null;

    /**
     * NextHopType 下一跳的类型。
     */
    public ?string $nextHopType = null;

    /**
     * CreateTime 路由的创建时间。
     */
    public ?string $createTime = null;
}
