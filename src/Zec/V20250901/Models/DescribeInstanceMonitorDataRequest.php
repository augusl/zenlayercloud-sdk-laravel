<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeInstanceMonitorDataRequest
 */
class DescribeInstanceMonitorDataRequest extends AbstractModel
{
    /**
     * InstanceId 实例唯一标识ID。
     */
    public ?string $instanceId = null;

    /**
     * MetricType 实例监控指标类型。
     */
    public ?string $metricType = null;

    /**
     * StartTime 查询开始时间。
     * 时间格式：yyyy-MM-ddTHH:mm:ssZ。
     */
    public ?string $startTime = null;

    /**
     * EndTime 查询结束时间。
     * 时间格式：yyyy-MM-ddTHH:mm:ssZ。
     */
    public ?string $endTime = null;

    /**
     * Step 查询数据点间隔。
     * 单位为分钟。
     * 支持参数：1,5。
     */
    public ?int $step = null;
}
