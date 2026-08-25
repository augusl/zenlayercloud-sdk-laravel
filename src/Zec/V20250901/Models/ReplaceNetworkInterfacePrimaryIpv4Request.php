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
 * ReplaceNetworkInterfacePrimaryIpv4Request
 */
class ReplaceNetworkInterfacePrimaryIpv4Request extends AbstractModel
{
    /**
     * NicId 需要变更的网卡ID。
     */
    public ?string $nicId = null;

    /**
     * PrimaryIpAddress 变更的目标内网IPv4地址。
     * 该地址必须属于子网的CIDR内，且未被使用。
     * 如果未指定，将自动分配子网内当前可用的最小IP地址。
     */
    public ?string $primaryIpAddress = null;

    /**
     * RebootInstance 是否在变更成功后自动重启已绑定的运行中实例，使新的主内网IPv4地址在实例内立即生效。
     * 默认为true。
     * 如果网卡未绑定实例、绑定的实例未处于运行中、或本次未产生实际变更（如指定了与当前相同的IP），则不会触发重启。
     */
    public ?bool $rebootInstance = null;
}
