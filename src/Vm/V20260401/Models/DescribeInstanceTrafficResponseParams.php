<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceTrafficResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataList 流量数据列表。
     *
     * @var list<InstanceTrafficData>|null
     */
    public ?array $dataList = null;

    /**
     * In95 入口带宽95值。
     */
    public ?int $in95 = null;

    /**
     * In95Time 入口带宽95值时间。
     */
    public ?string $in95Time = null;

    /**
     * InAvg 入口带宽平均值。
     */
    public ?int $inAvg = null;

    /**
     * InMax 入口带宽最大值。
     */
    public ?int $inMax = null;

    /**
     * InMin 入口带宽最小值。
     */
    public ?int $inMin = null;

    /**
     * InTotal 入口带宽总流量。
     */
    public ?int $inTotal = null;

    /**
     * Out95 出口带宽95值。
     */
    public ?int $out95 = null;

    /**
     * Out95Time 出口带宽95值时间。
     */
    public ?string $out95Time = null;

    /**
     * OutAvg 出口带宽平均值。
     */
    public ?int $outAvg = null;

    /**
     * OutMax 出口带宽最大值。
     */
    public ?int $outMax = null;

    /**
     * OutMin 出口带宽最小值。
     */
    public ?int $outMin = null;

    /**
     * OutTotal 出口带宽总流量。
     */
    public ?int $outTotal = null;

    /**
     * MaxBandwidth95ValueMbps 最大带宽95值，单位Mbps。
     */
    public ?float $maxBandwidth95ValueMbps = null;

    /**
     * TotalUnit 总流量单位。
     */
    public ?string $totalUnit = null;

    /**
     * Unit 带宽值单位。
     */
    public ?string $unit = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataList' => InstanceTrafficData::class,
    ];
}
