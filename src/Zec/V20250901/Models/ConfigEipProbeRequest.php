<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ConfigEipProbeRequest extends AbstractModel
{
    /**
     * EipId 配置公网探测的EIP ID。
     */
    public ?string $eipId = null;

    /**
     * DisableIcmp 是否禁用ICMP。
     */
    public ?bool $disableIcmp = null;

    /**
     * TcpPort TCP探测端口, [1-65535]。
     * 不传表示不开启。
     */
    public ?int $tcpPort = null;
}
