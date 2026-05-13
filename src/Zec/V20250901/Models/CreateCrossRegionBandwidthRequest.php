<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateCrossRegionBandwidthRequest
 */
class CreateCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * VpcId 创建内网跨区域带宽所在的VPC ID。
     */
    public ?string $vpcId = null;

    /**
     * InternetChargeType 网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * CrossRegionBandwidthName 内网跨区域带宽的名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $crossRegionBandwidthName = null;

    /**
     * MarketingInfo 市场营销的相关选项。
     */
    public ?MarketingInfo $marketingInfo = null;

    /**
     * RegionA 其中一端的区域连接点（A）。
     */
    public ?string $regionA = null;

    /**
     * RegionZ 另一端的区域连接点（Z）。
     */
    public ?string $regionZ = null;

    /**
     * Bandwidth 带宽|保底带宽。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * BandwidthCap 突发带宽。
     * 单位：Mbps。
     * 当且仅当internetChargeType为`ByInstanceBandwidth95`时此字段必填。
     */
    public ?int $bandwidthCap = null;
}
