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
 * AssignNetworkInterfaceIpv6Request
 */
class AssignNetworkInterfaceIpv6Request extends AbstractModel
{
    /**
     * NicId 要添加IPv6的网卡ID。
     * 可通过调用 ~~DescribeNetworkInterfaces~~ 获取。
     */
    public ?string $nicId = null;

    /**
     * InternetChargeType 公网IPv6的网络计费方式。
     * 当子网的堆栈类型包括V6且为公网时，需要指定。
     */
    public ?string $internetChargeType = null;

    /**
     * Bandwidth 公网IPv6的带宽限速。
     * 单位Mbps。
     * 当子网的堆栈类型包括V6且为公网时，需要指定。
     */
    public ?int $bandwidth = null;

    /**
     * PackageSize 公网IPv6的流量包大小。
     * 单位为TB。
     * 值要求为0或0.1的倍数。
     * 当子网堆栈类型包含IPv6且为公网，且网络计费方式为流量计费（`ByTrafficPackage`）时，需要指定该参数。
     */
    public ?float $packageSize = null;

    /**
     * ClusterId 公网IPv6所指定的共享带宽包ID。
     * 当子网堆栈类型包含IPv6且为公网，且网络计费方式为共享带宽包计费（`BandwidthCluster`）时，需要指定该参数。
     */
    public ?string $clusterId = null;

    /**
     * RateLimitMode 限速模式。
     * 严格模式(`STRICT`)必须同时指定`bandwidth`。
     */
    public ?string $rateLimitMode = null;
}
