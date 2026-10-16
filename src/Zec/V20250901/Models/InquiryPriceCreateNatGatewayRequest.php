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
 * InquiryPriceCreateNatGatewayRequest
 */
class InquiryPriceCreateNatGatewayRequest extends AbstractModel
{
    /**
     * RegionId 区域节点ID。
     * 可通过调用 ~~DescribeRegions~~ 获取。
     */
    public ?string $regionId = null;
}
