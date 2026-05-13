<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeQosPolicyGroupTrafficRequest extends AbstractModel
{
    /**
     * QosPolicyGroupId QoS策略组ID。
     */
    public ?string $qosPolicyGroupId = null;

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
     * Period 数据粒度，单位秒。
     * 支持的值：60、300、600、3600。
     */
    public ?int $period = null;
}
