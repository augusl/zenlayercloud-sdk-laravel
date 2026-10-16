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
 * PrivateIpInfo 公网弹性IP可以绑定的网卡及内网信息。
 */
class PrivateIpInfo extends AbstractModel
{
    /**
     * LanIp 该vNIC上已分配的内网IPv4地址，可用于与指定EIP进行绑定。
     */
    public ?string $lanIp = null;

    /**
     * NicId 弹性网卡（vNIC）的ID。
     */
    public ?string $nicId = null;

    /**
     * NicName 弹性网卡（vNIC）的名称。
     */
    public ?string $nicName = null;

    /**
     * InstanceId vNIC所挂载实例的ID。
     * 若vNIC未挂载至任何实例，则为null。
     */
    public ?string $instanceId = null;

    /**
     * InstanceName vNIC所挂载实例的名称。
     * 若vNIC未挂载至任何实例，则为null。
     */
    public ?string $instanceName = null;
}
