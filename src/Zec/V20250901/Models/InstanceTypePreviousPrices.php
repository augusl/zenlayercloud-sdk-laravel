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
 * InstanceTypePreviousPrices 变更前各计费项当前生效的价格。
 */
class InstanceTypePreviousPrices extends AbstractModel
{
    /**
     * SpecPrice 变更前规格的价格。
     */
    public ?PriceItem $specPrice = null;

    /**
     * GpuPrice 变更前 GPU 规格的价格。
     */
    public ?PriceItem $gpuPrice = null;

    /**
     * AcceleratorPrice 变更前加速卡规格的价格。
     */
    public ?PriceItem $acceleratorPrice = null;

    /**
     * SystemDiskPrice 变更前系统盘的价格。
     */
    public ?PriceItem $systemDiskPrice = null;
}
