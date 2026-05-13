<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * Region 支持售卖 ByoIP CIDR 的区域。
 */
class Region extends AbstractModel
{
    /**
     * Netmask 支持的网段。
     */
    public ?int $netmask = null;

    /**
     * RegionId 支持售卖的区域。
     */
    public ?string $regionId = null;

    /**
     * Network 支持的网络类型。
     */
    public ?string $network = null;

    /**
     * IpType 支持的IP类型。
     */
    public ?string $ipType = null;
}
