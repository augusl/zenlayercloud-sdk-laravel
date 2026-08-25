<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateDnatEntryRequest extends AbstractModel
{
    /**
     * NatGatewayId NAT网关 ID。
     */
    public ?string $natGatewayId = null;

    /**
     * EipId DNAT规则添加的弹性公网ID。
     */
    public ?string $eipId = null;

    /**
     * PrivateIp DNAT规则的内网IP地址。
     */
    public ?string $privateIp = null;

    /**
     * Protocol DNAT规则的协议类型。
     * 如果要转发所有流量，端口不变，请指定协议类型为`Any`且内部端口和公网外部端口不要设置。
     */
    public ?string $protocol = null;

    /**
     * ListenerPort DNAT规则端口转发的外部公网端口或端口段。
     * 可使用连字符（-）指定端口范围，例如：80-100，公网和内网端口数量需保持一致。
     * 取值范围1-65535。
     * 仅在协议类型不为`Any`时生效。
     */
    public ?string $listenerPort = null;

    /**
     * InternalPort DNAT规则端口转发的内部端口或端口段。
     * 可使用连字符（-）指定端口范围，例如：80-100，公网和内网端口数量需保持一致。
     * 取值范围1-65535。
     * 仅在协议类型不为`Any`时生效。
     */
    public ?string $internalPort = null;
}
