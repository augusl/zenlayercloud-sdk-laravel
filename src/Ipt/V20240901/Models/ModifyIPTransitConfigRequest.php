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
 * ModifyIPTransitConfigRequest
 */
class ModifyIPTransitConfigRequest extends AbstractModel
{
    /**
     * IptId IP Transit 实例 ID。
     */
    public ?string $iptId = null;

    /**
     * Type 变配操作类型。
     */
    public ?string $type = null;

    /**
     * Bandwidth 目标带宽（Mbps）。
     * type=BANDWIDTH 时必填。
     * 95 计费下必须大于等于生效后的 `commitBandwidth`。
     */
    public ?int $bandwidth = null;

    /**
     * CommitBandwidth 保底带宽（Mbps）。
     * type=BANDWIDTH 时有效，不填则与 `bandwidth` 相同。
     */
    public ?int $commitBandwidth = null;

    /**
     * Bfd BFD 配置。
     * type=BFD 时填写；传 null 表示关闭 BFD。
     * 高可用 IP Transit 不允许关闭 BFD。
     */
    public ?BFDConfig $bfd = null;

    /**
     * Bgp BGP 配置参数。
     * type=BGP_ROUTE_TYPE、BGP_ASN_AS_SET、BGP_PASSWORD 时必填，并填写对应子字段。
     */
    public ?BgpConfigParam $bgp = null;

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
