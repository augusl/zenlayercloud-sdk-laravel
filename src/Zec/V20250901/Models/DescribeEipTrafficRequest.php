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
 * DescribeEipTrafficRequest
 */
class DescribeEipTrafficRequest extends AbstractModel
{
    /**
     * EipId 要查询的弹性IP ID。
     */
    public ?string $eipId = null;

    /**
     * StartTime 查询开始时间。
     * 按照ISO8601标准表示，并且使用UTC时间。
     * 格式为：YYYY-MM-ddTHH:mm:ssZ。
     */
    public ?string $startTime = null;

    /**
     * EndTime 查询结束时间。
     * 按照ISO8601标准表示，并且使用UTC时间。
     * 格式为：YYYY-MM-ddTHH:mm:ssZ。
     */
    public ?string $endTime = null;

    /**
     * Step 查询数据点间隔。
     * 单位为分钟。
     * 支持参数：1,5。
     */
    public ?int $step = null;

    /**
     * WanIp 指定IP查询，可以指定IP地址查询流量。
     */
    public ?string $wanIp = null;

    /**
     * Direction 流量方向。
     * 仅 PathBasedBandwidthIP 类型有效；不传则返回全部方向数据。
     */
    public ?string $direction = null;
}
