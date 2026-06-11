<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeVmInventoryCapacityResponseParams
 */
class DescribeVmInventoryCapacityResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataSet 可用区库存集合。
     *
     * @var VmInventoryCapacityInfo[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => VmInventoryCapacityInfo::class,
    ];
}
