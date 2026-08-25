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
 * InstanceTrafficData 实例的带宽数据。
 */
class InstanceTrafficData extends AbstractModel
{
    /**
     * InternetRX 入口流量，单位bps。
     */
    public ?int $internetRX = null;

    /**
     * InternetTX 出口流量，单位bps。
     */
    public ?int $internetTX = null;

    /**
     * Time 时间。
     */
    public ?string $time = null;
}
