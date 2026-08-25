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
 * ChangeEipInternetChargeTypeRequest
 */
class ChangeEipInternetChargeTypeRequest extends AbstractModel
{
    /**
     * EipId 要操作的公网弹性IP。
     */
    public ?string $eipId = null;

    /**
     * InternetChargeType 要变更的目标网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * FlowPackage 流量包大小。
     * 单位：TB。
     * 网络计费方式为流量包计费（`ByTrafficPackage`）时需指定。
     */
    public ?float $flowPackage = null;

    /**
     * Bandwidth 带宽限速。
     * 单位：Mbps。
     * 网络计费方式为按带宽计费（`ByBandwidth`）时需指定。
     */
    public ?int $bandwidth = null;

    /**
     * Deprecated: BandwidthCap 已废弃，请不要使用。
     * BandwidthCap 已废弃，该参数不再生效。
     *
     * @deprecated
     */
    public ?int $bandwidthCap = null;

    /**
     * ClusterId 共享带宽包ID。
     * 变更为共享带宽包计费时需指定。
     */
    public ?string $clusterId = null;
}
