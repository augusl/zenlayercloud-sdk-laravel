<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeEipConcurrentConnsMonitorDataRequest
 */
class DescribeEipConcurrentConnsMonitorDataRequest extends AbstractModel
{
    /**
     * EipId EIP唯一标识ID。
     * 网络类型为PathBasedBandwidthIP的EIP不支持查询此指标，返回错误。
     * 与 instanceId 二选一。
     * 可通过调用 ~~DescribeEips~~ 获取。
     */
    public ?string $eipId = null;

    /**
     * InstanceId 实例ID。
     * 查询该实例绑定的所有IPv4 EIP的聚合数据（不含IPv6，且排除PathBasedBandwidthIP类型）。
     * 与 eipId 二选一。
     * 可通过调用 ~~DescribeInstances~~ 获取。
     */
    public ?string $instanceId = null;

    /**
     * MetricType 并发连接数监控指标类型。
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
     * 支持参数：1,5,15,60,360,1440,10080。
     * 取值为1时，查询时间跨度不能超过6小时。
     */
    public ?int $step = null;
}
