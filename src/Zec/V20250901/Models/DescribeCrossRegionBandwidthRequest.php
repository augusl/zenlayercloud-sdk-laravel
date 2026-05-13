<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeCrossRegionBandwidthRequest
 */
class DescribeCrossRegionBandwidthRequest extends AbstractModel
{
    /**
     * CrossRegionBandwidthIds 按照唯一ID过滤。
     */
    public ?array $crossRegionBandwidthIds = null;

    /**
     * CrossRegionBandwidthName 按照显示名称过滤，该字段支持模糊匹配。
     */
    public ?string $crossRegionBandwidthName = null;

    /**
     * VpcId 按照所属的VPC的ID过滤。
     */
    public ?string $vpcId = null;

    /**
     * RegionA 按照其中一端的区域连接点（A）过滤。
     */
    public ?string $regionA = null;

    /**
     * RegionZ 按照另一端的区域连接点（Z）过滤。
     */
    public ?string $regionZ = null;

    /**
     * Status 按照状态过滤。
     */
    public ?string $status = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页页码。
     */
    public ?int $pageNum = null;

    /**
     * ResourceGroupId 根据资源组ID过滤。
     */
    public ?string $resourceGroupId = null;
}
