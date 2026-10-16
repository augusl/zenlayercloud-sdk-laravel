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
 * NewConnsValue 描述新建连接数（CPS）监控指标的数据值。
 */
class NewConnsValue extends AbstractModel
{
    /**
     * Time 数据点时间。
     */
    public ?string $time = null;

    /**
     * AllValue All（入+出之和）的值。
     * 如果该值为null,表示取不到相应的值。
     */
    public ?float $allValue = null;

    /**
     * InValue In（入方向）的值。
     * 如果该值为null,表示取不到相应的值。
     */
    public ?float $inValue = null;

    /**
     * OutValue Out（出方向）的值。
     * 如果该值为null,表示取不到相应的值。
     */
    public ?float $outValue = null;
}
