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
 * SnatSubnet Snat规则添加的子网集合。
 */
class SnatSubnet extends AbstractModel
{
    /**
     * SubnetId 子网的ID。
     */
    public ?string $subnetId = null;

    /**
     * Cidr 子网的CIDR。
     */
    public ?string $cidr = null;
}
