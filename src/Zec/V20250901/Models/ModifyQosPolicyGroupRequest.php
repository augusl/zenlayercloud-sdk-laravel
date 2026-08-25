<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyQosPolicyGroupRequest extends AbstractModel
{
    /**
     * QosPolicyGroupId QoS策略组ID。
     */
    public ?string $qosPolicyGroupId = null;

    /**
     * Name QoS策略组新名称。
     * 长度不能超过64个字符。
     */
    public ?string $name = null;

    /**
     * BandwidthLimit 新的带宽限制，单位Mbps。
     * 最大不得超过100000000 Mbps。
     */
    public ?int $bandwidthLimit = null;

    /**
     * RateLimitMode 新的限速模式。
     */
    public ?string $rateLimitMode = null;
}
