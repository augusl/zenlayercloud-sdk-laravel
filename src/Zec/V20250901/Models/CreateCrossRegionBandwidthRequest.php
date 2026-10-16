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
 * CreateCrossRegionBandwidthRequest
 */
class CreateCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * VpcId 创建VPC跨区域带宽所在的VPC ID。
     * 可通过调用 ~~DescribeVpcs~~ 获取。
     */
    public ?string $vpcId = null;

    /**
     * InternetChargeType 网络计费类型。
     * 只支持`ByBandwidth`（固定带宽计费）和`ByInstanceBandwidth95`（单实例95计费）两种取值。
     * 当取值为`ByInstanceBandwidth95`时，突发带宽`bandwidthCap`为必填。
     */
    public ?string $internetChargeType = null;

    /**
     * CrossRegionBandwidthName VPC跨区域带宽的名称。
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
