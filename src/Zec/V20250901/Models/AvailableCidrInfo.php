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
 * AvailableCidrInfo 指定掩码长度下当前可创建的网段数量。
 */
class AvailableCidrInfo extends AbstractModel
{
    /**
     * PrefixLength 掩码长度。
     */
    public ?int $prefixLength = null;

    /**
     * Count 该掩码长度下当前可创建的网段数量。
     */
    public ?int $count = null;
}
