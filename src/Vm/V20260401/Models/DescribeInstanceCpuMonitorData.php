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
 * DescribeInstanceCpuMonitorData 描述CPU数据的信息。
 */
class DescribeInstanceCpuMonitorData extends AbstractModel
{
    /**
     * Cpu CPU使用率。
     */
    public ?string $cpu = null;

    /**
     * Time 时间。
     */
    public ?string $time = null;
}
