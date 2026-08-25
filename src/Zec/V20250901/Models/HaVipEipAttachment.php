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
 * HaVipEipAttachment HaVip关联EIP信息。
 */
class HaVipEipAttachment extends AbstractModel
{
    /**
     * EipId 弹性公网IP的ID。
     */
    public ?string $eipId = null;

    /**
     * EipAddress 弹性公网IP地址。
     */
    public ?string $eipAddress = null;
}
