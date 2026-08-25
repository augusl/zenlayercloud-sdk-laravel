<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyEipBandwidthLimitModeRequest extends AbstractModel
{
    /**
     * EipId 弹性公网IP的唯一ID。
     */
    public ?string $eipId = null;

    /**
     * RateLimitMode 新的限速模式。
     */
    public ?string $rateLimitMode = null;
}
