<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * PrivateIpInfo 公网弹性IP可以绑定的网卡及内网信息
 */
class PrivateIpInfo extends AbstractModel
{
    /**
     * LanIp 该 vNIC 上已分配的内网 IPv4 地址，可用于与指定 EIP 进行绑定。
     */
    public ?string $lanIp = null;

    /**
     * NicId 弹性网卡（vNIC）的 ID。
     */
    public ?string $nicId = null;

    /**
     * NicName 弹性网卡（vNIC）的名称。
     */
    public ?string $nicName = null;

    /**
     * InstanceId vNIC 所挂载实例的 ID。
     * 若 vNIC 未挂载至任何实例，则为 null。
     */
    public ?string $instanceId = null;

    /**
     * InstanceName vNIC 所挂载实例的名称。
     * 若 vNIC 未挂载至任何实例，则为 null。
     */
    public ?string $instanceName = null;
}
