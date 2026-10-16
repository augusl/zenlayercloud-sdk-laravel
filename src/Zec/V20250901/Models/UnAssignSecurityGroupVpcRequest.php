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
 * UnAssignSecurityGroupVpcRequest
 */
class UnAssignSecurityGroupVpcRequest extends AbstractModel
{
    /**
     * VpcId 要解绑的VPC ID。
     * 可通过调用 ~~DescribeVpcs~~ 获取。
     */
    public ?string $vpcId = null;
}
