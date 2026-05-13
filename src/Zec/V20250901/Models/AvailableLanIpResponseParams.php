<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AvailableLanIpResponseParams
 */
class AvailableLanIpResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * LanIps 可与指定 EIP 绑定的 vNIC 与内网 IP 组合列表。
     *
     * @var PrivateIpInfo[]|null
     */
    public ?array $lanIps = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'lanIps' => PrivateIpInfo::class,
    ];
}
