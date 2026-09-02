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
 * InquiryPriceModifyInstanceTypeResponseParams
 */
class InquiryPriceModifyInstanceTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SpecPrice 变更后规格的价格。
     * VM 实例变配时返回，GPU/加速卡实例变配时为 null。
     */
    public ?PriceItem $specPrice = null;

    /**
     * GpuPrice 变更后 GPU 规格的价格。
     * GPU 实例变配时返回，VM/加速卡实例变配时为 null。
     */
    public ?PriceItem $gpuPrice = null;

    /**
     * AcceleratorPrice 变更后加速卡规格的价格。
     * 加速卡实例变配时返回，VM/GPU 实例变配时为 null。
     */
    public ?PriceItem $acceleratorPrice = null;

    /**
     * SystemDiskPrice 系统盘的价格。
     */
    public ?PriceItem $systemDiskPrice = null;

    /**
     * PreviousPrices 变更前各计费项当前生效的价格，字段与上方一一对应，用于对比出哪些计费项发生了调价。
     * 实例无订单时为 null。
     */
    public ?InstanceTypePreviousPrices $previousPrices = null;
}
