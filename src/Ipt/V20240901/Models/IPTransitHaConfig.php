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
 * IPTransitHaConfig IP Transit HA配置信息。
 */
class IPTransitHaConfig extends AbstractModel
{
    /**
     * HaMode HA 运行模式。
     */
    public ?string $haMode = null;

    /**
     * SecondaryPortId 备链路接入数据中心端口 ID。
     * 与顶层 peerPortId 必须同城不同 DC。
     */
    public ?string $secondaryPortId = null;

    /**
     * SecondaryPortVlanId 备链路数据中心端口 VLAN ID。
     */
    public ?int $secondaryPortVlanId = null;
}
