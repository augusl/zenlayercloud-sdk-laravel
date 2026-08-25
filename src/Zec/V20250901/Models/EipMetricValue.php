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
 * EipMetricValue 描述EIP的监控指标数据。
 */
class EipMetricValue extends AbstractModel
{
    /**
     * Time 数据点时间。
     */
    public ?string $time = null;

    /**
     * InValue 入方向值。
     */
    public ?float $inValue = null;

    /**
     * OutValue 入方向值。
     */
    public ?float $outValue = null;

    /**
     * LoseIn 丢失入方向值。
     */
    public ?float $loseIn = null;

    /**
     * LoseOut 丢失出方向值。
     */
    public ?float $loseOut = null;
}
