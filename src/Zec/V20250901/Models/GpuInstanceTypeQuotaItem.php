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
 * GpuInstanceTypeQuotaItem 描述 GPU 规格在某可用区的售卖信息。
 */
class GpuInstanceTypeQuotaItem extends AbstractModel
{
    /**
     * ZoneId 可用区 ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType GPU 规格 ID。
     * 例如：z3a.g.C49.c8m32.1。
     * 变更规格时将此值传入 ModifyInstanceType 的 instanceType 参数。
     */
    public ?string $instanceType = null;

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
     * GpuAmount GPU 卡数。
     */
    public ?int $gpuAmount = null;

    /**
     * InstanceTypeName GPU 规格描述。
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
     * InventoryCapacity GPU 系列库存档位。
     */
    public ?string $inventoryCapacity = null;
}
