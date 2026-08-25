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
     * DiskPerf 扩容后云硬盘的性能配置信息。
     */
    public ?DiskPerfItem $diskPerf = null;
}
