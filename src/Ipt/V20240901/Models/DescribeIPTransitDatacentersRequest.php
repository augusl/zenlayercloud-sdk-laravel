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
 * DescribeIPTransitDatacentersRequest
 */
class DescribeIPTransitDatacentersRequest extends AbstractModel
{
    /**
     * PeerPortId 对端数据中心端口 ID。
     * 传入时查询以该数据中心端口为接入侧的可连接数据中心列表。
     */
    public ?string $peerPortId = null;

    /**
     * PeerDcId 对端数据中心 ID。
     */
    public ?string $peerDcId = null;

    /**
     * ZbgRegionId ZBG 接入节点 ID。
     * 非空时查询以该 ZBG 节点为接入侧的 Router RIPT 可连接 DC 列表。
     */
    public ?string $zbgRegionId = null;
}
