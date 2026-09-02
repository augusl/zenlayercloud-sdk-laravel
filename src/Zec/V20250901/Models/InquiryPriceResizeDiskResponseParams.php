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
 * InquiryPriceResizeDiskResponseParams
 */
class InquiryPriceResizeDiskResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DiskPrice 扩容后云硬盘的价格。
     */
    public ?PriceItem $diskPrice = null;

    /**
     * SpecPrice 系统盘扩容时，对应实例的规格价格。
     * 仅当云硬盘为系统盘且实例类型为 VM 时返回。
     */
    public ?PriceItem $specPrice = null;

    /**
     * GpuPrice 系统盘扩容时，对应实例的 GPU 价格。
     * 仅当云硬盘为系统盘且实例类型为 GPU 时返回。
     */
    public ?PriceItem $gpuPrice = null;

    /**
     * AcceleratorPrice 系统盘扩容时，对应实例的加速卡价格。
     * 仅当云硬盘为系统盘且实例类型为加速卡时返回。
     */
    public ?PriceItem $acceleratorPrice = null;

    /**
     * DiskPerf 扩容后云硬盘的性能配置信息。
     */
    public ?DiskPerfItem $diskPerf = null;

    /**
     * PreviousPrices 扩容前各计费项当前生效的价格，字段与上方一一对应，用于对比出哪些计费项发生了调价。
     * 无订单时为 null。
     */
    public ?ResizeDiskPreviousPrices $previousPrices = null;
}
