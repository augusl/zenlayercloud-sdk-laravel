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
 * DescribeIpv6CidrNetmasksRequest
 */
class DescribeIpv6CidrNetmasksRequest extends AbstractModel
{
    /**
     * RegionId 查询IPv6 CIDR所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * InstanceChargePostpaid 后付费的承诺期设置。
     * 指定period时会校验该承诺期是否已开通（未开通返回错误），并按其计算价格，需与询价、下单时传入的值一致；不传或未指定period时按承诺期1个月计算。
     */
    public ?ChargePostpaid $instanceChargePostpaid = null;
}
