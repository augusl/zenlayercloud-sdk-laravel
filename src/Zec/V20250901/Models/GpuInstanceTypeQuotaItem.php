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
 * GpuInstanceTypeQuotaItem 描述GPU规格在某可用区的售卖信息。
 */
class GpuInstanceTypeQuotaItem extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType GPU规格ID。
     * 例如：z3a.g.C49.c8m32.1。
     * 变更规格时将此值传入 ~~ModifyInstanceType~~ 的instanceType参数。
     */
    public ?string $instanceType = null;

    /**
     * CpuCount CPU核数。
     * 单位：核。
     */
    public ?int $cpuCount = null;

    /**
     * Memory 内存容量。
     * 单位：GiB。
     */
    public ?int $memory = null;

    /**
     * GpuAmount GPU卡数。
     */
    public ?int $gpuAmount = null;

    /**
     * InstanceTypeName GPU规格描述。
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
     * InventoryCapacity GPU系列库存档位。
     * 表示该GPU系列在对应可用区所在区域的库存量级：`LIMITED`（小于1000）、`NORMAL`（1000–2000）、`SUFFICIENT`（2000–5000）、`ABUNDANT`（不小于5000）。
     * GPU实例数量远低于上述阈值，实际可用时通常为`LIMITED`。
     */
    public ?string $inventoryCapacity = null;
}
