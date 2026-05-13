<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceTrafficRequest extends AbstractModel
{
    /**
     * InstanceId 实例ID。
     */
    public ?string $instanceId = null;

    /**
     * StartTime 查询开始时间。
     * ISO8601标准，UTC时间。
     */
    public ?string $startTime = null;

    /**
     * EndTime 查询结束时间。
     * ISO8601标准，UTC时间。
     */
    public ?string $endTime = null;
}
