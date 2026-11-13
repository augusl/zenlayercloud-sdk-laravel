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
 * DescribeNatGatewayNewConnsMonitorDataResponseParams
 */
class DescribeNatGatewayNewConnsMonitorDataResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * AllMaxValue All（入+出之和）数据点的最大值。
     */
    public ?float $allMaxValue = null;

    /**
     * AllMinValue All（入+出之和）数据点的最小值。
     */
    public ?float $allMinValue = null;

    /**
     * AllAvgValue All（入+出之和）数据点的平均值。
     */
    public ?float $allAvgValue = null;

    /**
     * InMaxValue In（入方向）数据点的最大值。
     */
    public ?float $inMaxValue = null;

    /**
     * InMinValue In（入方向）数据点的最小值。
     */
    public ?float $inMinValue = null;

    /**
     * InAvgValue In（入方向）数据点的平均值。
     */
    public ?float $inAvgValue = null;

    /**
     * OutMaxValue Out（出方向）数据点的最大值。
     */
    public ?float $outMaxValue = null;

    /**
     * OutMinValue Out（出方向）数据点的最小值。
     */
    public ?float $outMinValue = null;

    /**
     * OutAvgValue Out（出方向）数据点的平均值。
     */
    public ?float $outAvgValue = null;

    /**
     * DataList 监控数据集合。
     *
     * @var list<NatNewConnsValue>|null
     */
    public ?array $dataList = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataList' => NatNewConnsValue::class,
    ];
}
