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
 * TopPort 攻击端口。
 */
class TopPort extends AbstractModel
{
    /**
     * Protocol 协议。
     */
    public ?string $protocol = null;

    /**
     * Port 端口号。
     */
    public ?int $port = null;
}
