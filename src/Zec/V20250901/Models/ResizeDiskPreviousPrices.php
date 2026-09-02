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
 * ResizeDiskPreviousPrices 扩容前各计费项当前生效的价格。
 */
class ResizeDiskPreviousPrices extends AbstractModel
{
    /**
     * DiskPrice 扩容前云硬盘的价格。
     */
    public ?PriceItem $diskPrice = null;

    /**
     * SpecPrice 扩容前对应实例的规格价格。
     * 仅系统盘扩容且实例类型为 VM 时返回。
     */
    public ?PriceItem $specPrice = null;

    /**
     * GpuPrice 扩容前对应实例的 GPU 价格。
     * 仅系统盘扩容且实例类型为 GPU 时返回。
     */
    public ?PriceItem $gpuPrice = null;

    /**
     * AcceleratorPrice 扩容前对应实例的加速卡价格。
     * 仅系统盘扩容且实例类型为加速卡时返回。
     */
    public ?PriceItem $acceleratorPrice = null;
}
