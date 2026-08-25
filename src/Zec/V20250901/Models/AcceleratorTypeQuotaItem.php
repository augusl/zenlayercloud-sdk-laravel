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
 * AcceleratorTypeQuotaItem 描述加速卡规格在某可用区的售卖信息。
 */
class AcceleratorTypeQuotaItem extends AbstractModel
{
    /**
     * ZoneId 可用区 ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType 加速卡规格 ID。
     * 例如：z2a.v.T1U.c16m64.1。
     * 创建实例时将此值传入 CreateZecInstances 的 instanceType 参数。
     */
    public ?string $instanceType = null;

    /**
     * AcceleratorType 加速卡类型。
     * 取值范围：VPU。
     * 未来可能扩展 TPU/NPU/LPU 等。
     */
    public ?string $acceleratorType = null;

    /**
     * CpuCount CPU 核数。
     * 单位：核。
     */
    public ?int $cpuCount = null;

    /**
     * Memory 内存容量。
     * 单位：GiB。
     */
    public ?int $memory = null;

    /**
     * AcceleratorAmount 加速卡卡数。
     */
    public ?int $acceleratorAmount = null;

    /**
     * InstanceTypeName 加速卡规格描述。
     */
    public ?string $instanceTypeName = null;

    /**
     * Bps 单张网卡的带宽上限。
     * 单位：比特/秒。
     */
    public ?int $bps = null;

    /**
     * Pps 单张网卡的收发包上限。
     * 单位：个/秒。
     */
    public ?int $pps = null;

    /**
     * InventoryCapacity 加速卡系列库存档位。
     */
    public ?string $inventoryCapacity = null;

    /**
     * Price 该规格的价格。
     */
    public ?PriceItem $price = null;
}
