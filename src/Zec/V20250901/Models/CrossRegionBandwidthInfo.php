<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CrossRegionBandwidthInfo 描述内网跨区域带宽的基本信息。
 */
class CrossRegionBandwidthInfo extends AbstractModel
{
    /**
     * CrossRegionBandwidthId 内网跨区域带宽的唯一ID。
     */
    public ?string $crossRegionBandwidthId = null;

    /**
     * CrossRegionBandwidthName 内网跨区域带宽的名称。
     */
    public ?string $crossRegionBandwidthName = null;

    /**
     * Status 内网跨区域带宽的状态。
     */
    public ?string $status = null;

    /**
     * VpcId 内网跨区域带宽所属的VPC ID。
     */
    public ?string $vpcId = null;

    /**
     * RegionA 内网跨区域带宽的其中一端的区域连接点（A）。
     */
    public ?string $regionA = null;

    /**
     * RegionZ 内网跨区域带宽的另一端的区域连接点（Z）。
     */
    public ?string $regionZ = null;

    /**
     * Bandwidth 内网跨区域带宽的带宽|保底带宽。
     */
    public ?int $bandwidth = null;

    /**
     * BandwidthCap 内网跨区域带宽的突发带宽。
     * 该字段可能为null。
     */
    public ?int $bandwidthCap = null;

    /**
     * CreateTime 内网跨区域带宽的创建时间。
     */
    public ?string $createTime = null;

    /**
     * InternetChargeType 内网跨区域带宽的网络模型。
     */
    public ?string $internetChargeType = null;

    /**
     * ExpiredTime 内网跨区域带宽的到期时间。
     * 该字段可能为null。
     */
    public ?string $expiredTime = null;

    /**
     * ResourceGroupId 内网跨区域带宽的所属的资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 内网跨区域带宽的所属资源组的名称。
     */
    public ?string $resourceGroupName = null;
}
