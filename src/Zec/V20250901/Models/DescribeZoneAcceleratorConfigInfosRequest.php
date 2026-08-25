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
 * DescribeZoneAcceleratorConfigInfosRequest
 */
class DescribeZoneAcceleratorConfigInfosRequest extends AbstractModel
{
    /**
     * ZoneId 要查询的可用区 ID。
     * 例如：na-us-la-2a。
     * 不传时返回所有可用区的加速卡规格。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType 要查询的加速卡规格 ID。
     * 例如：z2a.v.T1U.c16m64.1。
     * 不传时返回所有规格。
     */
    public ?string $instanceType = null;
}
