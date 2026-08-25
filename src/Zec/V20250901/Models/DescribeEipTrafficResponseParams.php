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
 * DescribeEipTrafficResponseParams
 */
class DescribeEipTrafficResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataList 查询的数据点。
     *
     * @var list<EipTrafficData>|null
     */
    public ?array $dataList = null;

    /**
     * In95 入方向带宽95值。
     * 单位：bps。
     */
    public ?int $in95 = null;

    /**
     * InAvg 入方向带宽平均值。
     * 单位：bps。
     */
    public ?int $inAvg = null;

    /**
     * InMax 入方向带宽的最大值。
     * 单位：bps。
     */
    public ?int $inMax = null;

    /**
     * InMin 入方向带宽的最小值。
     * 单位：bps。
     */
    public ?int $inMin = null;

    /**
     * InTotal 入方向的总字节。
     * 单位：Byte。
     */
    public ?int $inTotal = null;

    /**
     * Out95 出方向带宽95值。
     * 单位：bps。
     */
    public ?int $out95 = null;

    /**
     * OutAvg 出方向带宽平均值。
     * 单位：bps。
     */
    public ?int $outAvg = null;

    /**
     * OutMax 出方向带宽最大值。
     * 单位：bps。
     */
    public ?int $outMax = null;

    /**
     * OutMin 出方向带宽最小值。
     * 单位：bps。
     */
    public ?int $outMin = null;

    /**
     * OutTotal 入方向的总字节。
     * 单位：bps。
     */
    public ?int $outTotal = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataList' => EipTrafficData::class,
    ];
}
