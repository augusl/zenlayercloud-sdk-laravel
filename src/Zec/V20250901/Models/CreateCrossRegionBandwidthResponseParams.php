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
 * CreateCrossRegionBandwidthResponseParams
 */
class CreateCrossRegionBandwidthResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * OrderNumber 下单编号。
     */
    public ?string $orderNumber = null;

    /**
     * CrossRegionBandwidthId 内网跨区域带宽唯一ID。
     */
    public ?string $crossRegionBandwidthId = null;
}
