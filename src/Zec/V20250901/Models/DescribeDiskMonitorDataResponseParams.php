<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDiskMonitorDataResponseParams
 */
class DescribeDiskMonitorDataResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * MaxValue 数据点的最大值。
     */
    public ?float $maxValue = null;

    /**
     * MinValue 数据点的最小值。
     */
    public ?float $minValue = null;

    /**
     * AvgValue 数据点的平均值。
     */
    public ?float $avgValue = null;

    /**
     * Metrics 监控数据集合。
     *
     * @var MetricValue[]|null
     */
    public ?array $metrics = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'metrics' => MetricValue::class,
    ];
}
