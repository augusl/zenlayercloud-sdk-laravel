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
 * InquiryPriceCreateDisksResponseParams
 */
class InquiryPriceCreateDisksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataDiskPrice 云硬盘的价格。
     */
    public ?PriceItem $dataDiskPrice = null;
}
