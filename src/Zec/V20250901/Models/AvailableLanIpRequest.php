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
 * AvailableLanIpRequest
 */
class AvailableLanIpRequest extends AbstractModel
{
    /**
     * EipId 待查询的弹性公网 IP 的 ID。
     * 接口将返回与该 EIP 同地域子网下的所有可绑定 vNIC 及内网 IP。
     * 可通过 ~~DescribeEips~~ 接口获取 EIP ID。
     */
    public ?string $eipId = null;
}
