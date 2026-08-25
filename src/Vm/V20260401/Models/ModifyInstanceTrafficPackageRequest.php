<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyInstanceTrafficPackageRequest extends AbstractModel
{
    /**
     * InstanceId 待操作的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * TrafficPackageSize 流量包大小，单位TB。
     */
    public ?float $trafficPackageSize = null;
}
