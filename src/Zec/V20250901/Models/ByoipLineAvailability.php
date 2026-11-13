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
 * ByoipLineAvailability 线路的BYOIP支持状态。
 */
class ByoipLineAvailability extends AbstractModel
{
    /**
     * Network 网络线路类型。
     */
    public ?string $network = null;

    /**
     * Status 支持状态。
     */
    public ?string $status = null;
}
