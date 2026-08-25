<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ZoneInfo 可用区的基本信息。
 */
class ZoneInfo extends AbstractModel
{
    /**
     * ZoneId 区域ID。
     */
    public ?string $zoneId = null;

    /**
     * ZoneName 区域名称。
     */
    public ?string $zoneName = null;

    /**
     * SupportSecurityGroup 是否支持安全组。
     */
    public ?bool $supportSecurityGroup = null;

    /**
     * SupportNetworkType 支持的网络类型。
     * CLASSICS：经典网络。
     * VPC：VPC网络。
     */
    public ?string $supportNetworkType = null;

    /**
     * SupportIpv6 是否支持公网IPv6。
     */
    public ?bool $supportIpv6 = null;

    /**
     * SupportCpuPassThrough 是否支持CPU透传。
     */
    public ?bool $supportCpuPassThrough = null;

    /**
     * NetworkLineType 网络线路信息。
     */
    public ?string $networkLineType = null;
}
