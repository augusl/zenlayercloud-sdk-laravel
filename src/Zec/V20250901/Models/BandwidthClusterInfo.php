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
 * BandwidthClusterInfo 描述带宽组的基本信息。
 */
class BandwidthClusterInfo extends AbstractModel
{
    /**
     * BandwidthClusterId 共享带宽包ID。
     */
    public ?string $bandwidthClusterId = null;

    /**
     * BandwidthClusterName 共享带宽包名称。
     */
    public ?string $bandwidthClusterName = null;
}
