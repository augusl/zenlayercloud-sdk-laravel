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
 * InstanceTypeQuotaItem 描述可用区的机型配置信息。
 */
class InstanceTypeQuotaItem extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType 实例机型。
     */
    public ?string $instanceType = null;

    /**
     * InstanceTypeName 实例机型名称。
     */
    public ?string $instanceTypeName = null;

    /**
     * CpuCount CPU核数。
     */
    public ?int $cpuCount = null;

    /**
     * Memory 内存大小，单位GiB。
     */
    public ?int $memory = null;

    /**
     * InternetMaxBandwidthOutLimit 公网出口带宽上限。
     */
    public ?int $internetMaxBandwidthOutLimit = null;

    /**
     * Frequency CPU主频。
     */
    public ?string $frequency = null;

    /**
     * InternetChargeTypes 支持的网络计费类型列表。
     *
     * @var list<string>|null
     */
    public ?array $internetChargeTypes = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'internetChargeTypes' => 'string',
    ];
}
