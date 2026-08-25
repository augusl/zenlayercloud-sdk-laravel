<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeZoneInstanceConfigInfosRequest extends AbstractModel
{
    /**
     * InstanceChargeType 实例计费类型。
     * PREPAID：预付费。
     * POSTPAID：后付费。
     */
    public ?string $instanceChargeType = null;

    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType 实例机型。
     */
    public ?string $instanceType = null;
}
