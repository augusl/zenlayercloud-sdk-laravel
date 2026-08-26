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
 * DescribeIPTransitAvailableCidrBlocksRequest
 */
class DescribeIPTransitAvailableCidrBlocksRequest extends AbstractModel
{
    /**
     * IptDcId 目标数据中心 ID。
     * 传入 `ipUuid` 时可不传，将从该 IP 块所在数据中心自动推导。
     */
    public ?string $iptDcId = null;

    /**
     * RoutingType 路由类型。
     * 不同路由类型下可用掩码范围不同；不传则返回全量掩码。
     */
    public ?string $routingType = null;

    /**
     * ZbgRegionId ZBG 区域 ID。
     * ZBG 场景下必传。
     */
    public ?string $zbgRegionId = null;

    /**
     * IpUuid IP 地址 UUID。
     * 传入后接口会自动推导所属数据中心和路由类型，仅返回掩码长度不小于当前 IP 块的可选项。
     */
    public ?string $ipUuid = null;
}
