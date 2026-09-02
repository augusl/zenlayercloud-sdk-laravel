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
 * DescribeCrossRegionBandwidthMonitorDataResponseParams
 */
class DescribeCrossRegionBandwidthMonitorDataResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InMaxValue 入方向最大值。
     */
    public ?float $inMaxValue = null;

    /**
     * InAvgValue 入方向平均值。
     */
    public ?float $inAvgValue = null;

    /**
     * InMinValue 入方向最小值。
     */
    public ?float $inMinValue = null;

    /**
     * InTotalValue 入方向总和值。
     */
    public ?float $inTotalValue = null;

    /**
     * OutMaxValue 出方向最大值。
     */
    public ?float $outMaxValue = null;

    /**
     * OutAvgValue 出方向平均值。
     */
    public ?float $outAvgValue = null;

    /**
     * OutMinValue 出方向最小值。
     */
    public ?float $outMinValue = null;

    /**
     * OutTotalValue 出方向总和值。
     */
    public ?float $outTotalValue = null;

    /**
     * LoseInMaxValue 入方向丢弃量最大值。
     */
    public ?float $loseInMaxValue = null;

    /**
     * LoseInMinValue 入方向丢弃量最小值。
     */
    public ?float $loseInMinValue = null;

    /**
     * LoseInTotalValue 入方向丢弃量总和值。
     */
    public ?float $loseInTotalValue = null;

    /**
     * LoseOutMaxValue 出方向丢弃量最大值。
     */
    public ?float $loseOutMaxValue = null;

    /**
     * LoseOutMinValue 出方向丢弃量最小值。
     */
    public ?float $loseOutMinValue = null;

    /**
     * LoseOutTotalValue 出方向丢弃量总和值。
     */
    public ?float $loseOutTotalValue = null;

    /**
     * DataList 监控数据集合。
     *
     * @var list<CrossRegionBandwidthMetricValue>|null
     */
    public ?array $dataList = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataList' => CrossRegionBandwidthMetricValue::class,
    ];
}
