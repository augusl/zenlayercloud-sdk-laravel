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
 * DescribeIpv6CidrPriceRequest
 */
class DescribeIpv6CidrPriceRequest extends AbstractModel
{
    /**
     * RegionId 查询IPv6 CIDR所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * NetworkLineType 查询IPv6 CIDR的IP线路类型。
     */
    public ?string $networkLineType = null;

    /**
     * Netmask 需要查询的CIDR掩码与数量。
     */
    public ?Ipv6NetmaskInfo $netmask = null;

    /**
     * InstanceChargePostpaid 后付费的承诺期设置。
     * 仅支持账号已开通的承诺期时长，需与下单时传入的值一致。
     */
    public ?ChargePostpaid $instanceChargePostpaid = null;

    /**
     * MarketingOptions 市场营销相关的选项。
     */
    public ?MarketingInfo $marketingOptions = null;
}
