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
 * ByoipCreateItem 创建 BYOIP 单项。
 */
class ByoipCreateItem extends AbstractModel
{
    /**
     * CidrBlock 宣告IPv4或IPv6地址段。
     */
    public ?string $cidrBlock = null;

    /**
     * NetworkType 线路类型。
     * IPv6仅支持PremiumBGP。
     */
    public ?string $networkType = null;

    /**
     * RegionId 区域id。
     */
    public ?string $regionId = null;

    /**
     * Asn ASN号。
     */
    public ?int $asn = null;

    /**
     * SubnetMaskLength 该参数仅在`cidrBlock`字段为IPv6地址段时生效。
     * 分配给子网的掩码长度。
     * 必须大于或等于CIDR的掩码长度。
     * 与CIDR的掩码长度范围差值小于等于4, 最大值为64。
     * 默认为CIDR的掩码长度。
     */
    public ?int $subnetMaskLength = null;
}
