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
 * MarketingInfo 描述市场活动的相关信息。
 */
class MarketingInfo extends AbstractModel
{
    /**
     * DiscountCode 使用市场发放的折扣码。
     * 如果折扣码不存在，最终折扣将不会生效。
     */
    public ?string $discountCode = null;

    /**
     * UsePocVoucher 是否使用POC代金券。
     * 如果系统不存在POC代金券，相关创建流程会失败。
     */
    public ?bool $usePocVoucher = null;
}
