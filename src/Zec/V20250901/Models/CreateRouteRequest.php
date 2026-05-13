<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateRouteRequest extends AbstractModel
{
    /**
     * VpcId VPC的ID。
     */
    public ?string $vpcId = null;

    /**
     * IpVersion IP类型。
     * 支持`IPv4`和`IPv6`两种类型。
     */
    public ?string $ipVersion = null;

    /**
     * RouteType 路由类型。
     */
    public ?string $routeType = null;

    /**
     * SourceCidrBlock 源IP地址CIDR。
     * `路由类型`配置`RouteTypePolicy(策略路由)`时需指定。
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
     * 数值越小，优先级越高。
     */
    public ?int $priority = null;

    /**
     * NextHopId 下一跳资源ID。
     * 目前只支持网卡ID。
     */
    public ?string $nextHopId = null;

    /**
     * NextHotId 下一跳资源ID。
     * 目前只支持网卡ID。
     * 该字段已废弃， 请使用`nextHopId`。
     */
    public ?string $nextHotId = null;

    /**
     * Name 路由名称。
     * 名称长度为 2 到 63 个字符，仅支持字母、数字、连字符 (-) 、下划线(_) 、斜杠(/) 、和句点 (.)，且开头和结尾必须是字母或数字。
     */
    public ?string $name = null;
}
