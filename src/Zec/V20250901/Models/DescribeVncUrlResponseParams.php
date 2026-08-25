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
 * DescribeVncUrlResponseParams
 */
class DescribeVncUrlResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Url VNC地址URL。
     */
    public ?string $url = null;
}
