<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeIPTransitTrafficResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataList 带宽数据列表。
     *
     * @var list<TrafficData>|null
     */
    public ?array $dataList = null;

    /**
     * In95 入口带宽95值。
     */
    public ?int $in95 = null;

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
     * Out95 出口带宽95值。
     */
    public ?int $out95 = null;

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
     * Unit 带宽值单位。例如：bps。
     */
    public ?string $unit = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataList' => TrafficData::class,
    ];
}
