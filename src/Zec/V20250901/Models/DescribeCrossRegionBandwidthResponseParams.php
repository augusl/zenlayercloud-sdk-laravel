<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeCrossRegionBandwidthResponseParams
 */
class DescribeCrossRegionBandwidthResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 匹配筛选条件的内网跨区域带宽的总数量。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 返回分页的内网跨区域带宽的集合数据。
     *
     * @var CrossRegionBandwidthInfo[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => CrossRegionBandwidthInfo::class,
    ];
}
