<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDiskMonitorDataRequest
 */
class DescribeDiskMonitorDataRequest extends AbstractModel
{
    /**
     * DiskId 云硬盘唯一标识ID。
     */
    public ?string $diskId = null;

    /**
     * MetricType 云硬盘监控指标类型。
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
}
