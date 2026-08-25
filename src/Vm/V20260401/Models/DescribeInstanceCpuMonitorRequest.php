<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceCpuMonitorRequest extends AbstractModel
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
