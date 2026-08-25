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
 * InquiryPriceChangeEipInternetChargeTypeRequest
 */
class InquiryPriceChangeEipInternetChargeTypeRequest extends AbstractModel
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
     * Bandwidth 带宽限速。
     * 单位：Mbps。
     * 网络计费方式为按带宽计费（`ByBandwidth`）时需指定。
     */
    public ?int $bandwidth = null;

    /**
     * FlowPackage 流量包大小。
     * 单位：TB。
     * 网络计费方式为流量包计费（`ByTrafficPackage`）时需指定。
     */
    public ?float $flowPackage = null;

    /**
     * ClusterId 共享带宽包ID。
     * 网络计费方式为共享带宽包计费（`BandwidthCluster`）时需指定。
     */
    public ?string $clusterId = null;
}
