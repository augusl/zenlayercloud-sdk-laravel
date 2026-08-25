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
 * DnatEntry 描述DNAT规则的信息。
 */
class DnatEntry extends AbstractModel
{
    /**
     * DnatEntryId DNAT规则 ID。
     */
    public ?string $dnatEntryId = null;

    /**
     * Status DNAT规则状态。
     */
    public ?string $status = null;

    /**
     * PrivateIp DNAT规则的内网IP地址。
     */
    public ?string $privateIp = null;

    /**
     * EipId DNAT规则添加的eip ID。
     */
    public ?string $eipId = null;

    /**
     * Protocol DNAT规则的协议类型。
     */
    public ?string $protocol = null;

    /**
     * ListenerPort DNAT规则端口转发的外部端口或端口段，取值范围1-65535。
     */
    public ?string $listenerPort = null;

    /**
     * InternalPort DNAT规则端口转发的内部端口或端口段，取值范围1-65535。
     */
    public ?string $internalPort = null;
}
