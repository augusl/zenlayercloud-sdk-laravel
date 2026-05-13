<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeQosPolicyGroupTrafficResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataSet 流量监控数据点列表。
     *
     * @var TrafficDataPoint[]|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => TrafficDataPoint::class,
    ];
}
