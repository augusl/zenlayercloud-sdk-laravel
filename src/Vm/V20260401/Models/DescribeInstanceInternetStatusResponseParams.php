<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstanceInternetStatusResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceId 虚拟机实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceName 实例的名称。
     */
    public ?string $instanceName = null;

    /**
     * InternetMaxBandwidthOut 当前实例的公网出口带宽大小。
     */
    public ?int $internetMaxBandwidthOut = null;

    /**
     * ModifiedInternetMaxBandwidthOut 实例将要修改公网出口带宽大小。
     */
    public ?int $modifiedInternetMaxBandwidthOut = null;

    /**
     * ModifiedBandwidthStatus 实例带宽状态。
     * Processing：变更中。
     * Enable：可用。
     * WaitToEnable：下周期变更。
     */
    public ?string $modifiedBandwidthStatus = null;

    /**
     * TrafficPackageSize 当前实例流量包大小，单位TB。
     */
    public ?float $trafficPackageSize = null;

    /**
     * ModifiedTrafficPackageSize 实例要修改流量包大小，单位TB。
     */
    public ?float $modifiedTrafficPackageSize = null;

    /**
     * ModifiedTrafficPackageStatus 实例流量包状态。
     * Processing：变更中。
     * Enable：可用。
     * WaitToEnable：下周期变更。
     */
    public ?string $modifiedTrafficPackageStatus = null;
}
