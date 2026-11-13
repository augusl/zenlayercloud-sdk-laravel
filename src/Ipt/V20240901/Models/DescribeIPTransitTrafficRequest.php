<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeIPTransitTrafficRequest
 */
class DescribeIPTransitTrafficRequest extends AbstractModel
{
    /**
     * IptId Internet ID。
     */
    public ?string $iptId = null;

    /**
     * StartTime 查询开始时间。
     * ISO8601 UTC 格式：YYYY-MM-DDThh:mm:ssZ。
     */
    public ?string $startTime = null;

    /**
     * EndTime 查询结束时间。
     * ISO8601 UTC 格式：YYYY-MM-DDThh:mm:ssZ，默认为当前时间。
     */
    public ?string $endTime = null;

    /**
     * Period 数据采样周期。
     * 单位为秒，可选值：20、40、60、120、300、900。
     */
    public ?int $period = null;

    /**
     * Statistic 采样周期内流量数据的统计方式。
     */
    public ?string $statistic = null;
}
