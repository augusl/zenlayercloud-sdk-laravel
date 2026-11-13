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
 * DescribeNatGatewayNewConnsMonitorDataRequest
 */
class DescribeNatGatewayNewConnsMonitorDataRequest extends AbstractModel
{
    /**
     * NatGatewayId NAT网关ID。
     * 可通过调用 **DescribeNatGateways** 获取。
     */
    public ?string $natGatewayId = null;

    /**
     * MetricType 新建连接数监控指标类型。
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
     */
    public ?int $step = null;
}
