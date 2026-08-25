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
 * MetricValue 描述监控指标的数据值。
 */
class MetricValue extends AbstractModel
{
    /**
     * Time 数据点时间。
     */
    public ?string $time = null;

    /**
     * Value 数据点的值。
     * 如果该值为null,表示取不到相应的值。
     */
    public ?float $value = null;
}
