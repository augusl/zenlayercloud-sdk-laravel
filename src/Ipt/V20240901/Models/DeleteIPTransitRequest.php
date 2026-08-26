<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteIPTransitRequest
 */
class DeleteIPTransitRequest extends AbstractModel
{
    /**
     * IptId IP Transit ID。
     */
    public ?string $iptId = null;
}
