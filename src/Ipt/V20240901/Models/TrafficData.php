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
 * TrafficData 描述带宽的数据点信息。
 */
class TrafficData extends AbstractModel
{
    /**
     * InternetRX 入方向带宽值。
     * 单位：bps。
     */
    public ?int $internetRX = null;

    /**
     * InternetTX 出方向带宽值。
     * 单位：bps。
     */
    public ?int $internetTX = null;

    /**
     * Time 数据时间。
     * 按照ISO8601标准表示，并且使用UTC时间。
     * 格式为：YYYY-MM-ddTHH:mm:ssZ。
     */
    public ?string $time = null;
}
