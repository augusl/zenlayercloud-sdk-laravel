<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryModifyIPTransitPriceRequest
 */
class InquiryModifyIPTransitPriceRequest extends AbstractModel
{
    /**
     * IptId IP Transit 实例 ID。
     */
    public ?string $iptId = null;

    /**
     * Type 变配类型。
     * 支持 BANDWIDTH、ADD_CIDR_BLOCK、DEL_CIDR_BLOCK、EXPAND_CIDR_BLOCK、SHRINK_CIDR_BLOCK，BFD/BGP/HA 操作无费用，不允许传入。
     */
    public ?string $type = null;

    /**
     * Bandwidth 目标带宽（Mbps）。
     * type=BANDWIDTH 时必填。
     * 95 计费下必须大于等于 `commitBandwidth`。
     */
    public ?int $bandwidth = null;

    /**
     * CommitBandwidth 保底带宽（Mbps）。
     * type=BANDWIDTH 时有效，不填则与 `bandwidth` 相同；95 计费（internetType=ByInstanceBandwidth95）下必填，不能用 `bandwidth` 代替。
     */
    public ?int $commitBandwidth = null;

    /**
     * PublicIPv4BlockSize IPv4 CIDR 掩码长度（24–32）。
     * type=ADD_CIDR_BLOCK、EXPAND_CIDR_BLOCK、SHRINK_CIDR_BLOCK 时必填。
     */
    public ?int $publicIPv4BlockSize = null;

    /**
     * IpUuid 目标 IP 块 UUID。
     * type=DEL_CIDR_BLOCK、EXPAND_CIDR_BLOCK、SHRINK_CIDR_BLOCK 时必填。
     */
    public ?string $ipUuid = null;

    /**
     * IpNetworkType IP 网络类型。
     * type=ADD_CIDR_BLOCK 时有效，默认 BGP_IP。
     */
    public ?string $ipNetworkType = null;
}
