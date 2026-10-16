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
 * AssignBorderGatewayRequest
 */
class AssignBorderGatewayRequest extends AbstractModel
{
    /**
     * ZbgId 边界网关ID。
     * 可通过调用 ~~DescribeBorderGateways~~ 获取。
     */
    public ?string $zbgId = null;

    /**
     * NatId NAT网关ID。
     * 可通过调用 ~~DescribeNatGateways~~ 获取。
     */
    public ?string $natId = null;
}
