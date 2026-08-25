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
 * ChargePostpaid 后付费模式，即按量付费相关参数设置。
 */
class ChargePostpaid extends AbstractModel
{
    /**
     * Period 后付费时长。
     * 单位：月。
     */
    public ?int $period = null;
}
