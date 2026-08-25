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
 * DescribePolicyDetailRequest
 */
class DescribePolicyDetailRequest extends AbstractModel
{
    /**
     * PolicyId 防护策略ID。
     */
    public ?string $policyId = null;
}
