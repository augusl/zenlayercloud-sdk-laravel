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
     * Remark 库存容量档位说明，描述各档位对应的可售核数范围。
     */
    public ?string $remark = null;

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
