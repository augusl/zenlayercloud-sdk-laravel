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
 * ModifyBorderGatewayInterconnectCidrRequest
 */
class ModifyBorderGatewayInterconnectCidrRequest extends AbstractModel
{
    /**
     * ZbgId 要修改的边界网关ID。
     * 可通过调用 **DescribeBorderGateways** 获取。
     */
    public ?string $zbgId = null;

    /**
     * InterConnectCidr 互联IP网段。
     * 仅支持169.254.x.x/27。
     */
    public ?string $interConnectCidr = null;
}
