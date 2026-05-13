<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeNetworkInterfaceMonitorDataRequest
 */
class DescribeNetworkInterfaceMonitorDataRequest extends AbstractModel
{
    /**
     * NicId 网卡唯一标识ID。
     */
    public ?string $nicId = null;

    /**
     * MetricType 网卡监控指标类型。
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
