<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * UnmanagedEgressIpInfo 描述非托管出口IP的信息。
 */
class UnmanagedEgressIpInfo extends AbstractModel
{
    /**
     * UnmanagedEgressIpId 非托管出口IP的唯一ID。
     */
    public ?string $unmanagedEgressIpId = null;

    /**
     * Ip 公网IP地址。
     */
    public ?string $ip = null;

    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * VpcId 所属VPC的唯一ID。
     */
    public ?string $vpcId = null;

    /**
     * Status 资源状态。
     */
    public ?string $status = null;

    /**
     * NetworkLineType 网络类型。
     */
    public ?string $networkLineType = null;

    /**
     * InternetChargeType 网络计费方式。
     */
    public ?string $internetChargeType = null;

    /**
     * BandwidthCap 带宽上限，单位 Mbps。
     * 无固定带宽时为 null。
     */
    public ?int $bandwidthCap = null;

    /**
     * RateLimitMode 限速模式。
     */
    public ?string $rateLimitMode = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;
}
