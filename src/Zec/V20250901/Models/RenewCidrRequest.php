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
 * RenewCidrRequest
 */
class RenewCidrRequest extends AbstractModel
{
    /**
     * CidrId 要恢复的CIDR ID。
     * 可通过调用 ~~DescribeCidrs~~ 获取。
     */
    public ?string $cidrId = null;
}
