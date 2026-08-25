<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ChargePrepaid 预付费模式，即包年包月相关参数设置。
 */
class ChargePrepaid extends AbstractModel
{
    /**
     * Period 购买实例的时长。
     * 单位：月。
     */
    public ?int $period = null;
}
