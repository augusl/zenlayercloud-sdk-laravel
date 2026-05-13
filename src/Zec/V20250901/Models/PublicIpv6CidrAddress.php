<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * PublicIpv6CidrAddress 公网IPv6的基本信息。
 */
class PublicIpv6CidrAddress extends AbstractModel
{
    /**
     * Ipv6CidrId IPv6 CIDR的ID。
     */
    public ?string $ipv6CidrId = null;

    /**
     * Ipv6Cidr IPv6 CIDR的地址。
     */
    public ?string $ipv6Cidr = null;

    /**
     * PrimaryIpv6Address 网卡的主IPv6地址。
     */
    public ?string $primaryIpv6Address = null;

    /**
     * InternetChargeType IPv6的网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * Bandwidth IPv6的公网带宽限速。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;

    /**
     * TrafficPackageSize IPv6的流量包大小。
     * 单位：TB。
     */
    public ?float $trafficPackageSize = null;

    /**
     * BandwidthCluster 关联的带宽组信息。
     */
    public ?BandwidthClusterInfo $bandwidthCluster = null;
}
