<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeVmInventoryCapacityResponseParams
 */
class DescribeVmInventoryCapacityResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataSet 各节点库存容量列表。
     *
     * @var VmRegionCapacityItem[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => VmRegionCapacityItem::class,
    ];
}
