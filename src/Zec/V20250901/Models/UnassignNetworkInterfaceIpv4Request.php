<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class UnassignNetworkInterfaceIpv4Request extends AbstractModel
{
    /**
     * NicId 网卡ID。
     */
    public ?string $nicId = null;

    /**
     * Deprecated: IpAddress 已废弃，请不要使用。
     * IpAddress 需要解绑的IPv4地址。
     * 该字段已过时，请使用`ipAddresses`，如果两者均指定， 则以`ipAddresses`为准。
     */
    public ?string $ipAddress = null;

    /**
     * IpAddresses 需要解绑的内网IPv4地址。
     */
    public ?array $ipAddresses = null;
}
