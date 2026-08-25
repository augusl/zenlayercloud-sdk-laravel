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
 * ModifySubnetStackTypeRequest
 */
class ModifySubnetStackTypeRequest extends AbstractModel
{
    /**
     * SubnetId 要操作的子网的ID。
     */
    public ?string $subnetId = null;

    /**
     * StackType 子网堆栈类型。
     * `IPv4_IPv6`: 开启公网IPv6; 公网或内网由`ipv6Type`指定。
     * `IPv4`: 将关闭IPv6，关闭前须确保子网内所有网卡已通过 `UnassignNetworkInterfaceIpv6` 删除其 IPv6 地址。
     */
    public ?string $stackType = null;

    /**
     * Ipv6Type IPv6 的类型。
     * 当`stackType`为`IPv4_IPv6`时必填。
     */
    public ?string $ipv6Type = null;

    /**
     * Ipv6CidrBlockId 公网IPv6 CIDR ID。
     * 该字段仅当`ipv6Type`是公网(`Public`)时允许指定。
     * 如果不指定，将从系统默认IP池里分配。
     */
    public ?string $ipv6CidrBlockId = null;

    /**
     * Ipv6MaskLength 分配给虚拟机（VM）的IPv6 CIDR前缀的大小。
     * 该参数必须与`ipv6CidrBlockId`参数配合使用。
     * 当未显式传递时，默认值为96。
     * 最小必须大于或等于指定`ipv6CidrBlockId`的前缀，最大不能超过96。
     */
    public ?int $ipv6MaskLength = null;
}
