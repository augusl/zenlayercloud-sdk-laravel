<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceCpuMonitorResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataList CPU使用率列表。
     *
     * @var list<DescribeInstanceCpuMonitorData>|null
     */
    public ?array $dataList = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataList' => DescribeInstanceCpuMonitorData::class,
    ];
}
