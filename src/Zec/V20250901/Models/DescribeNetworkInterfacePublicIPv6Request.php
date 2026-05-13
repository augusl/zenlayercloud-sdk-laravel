<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeNetworkInterfacePublicIPv6Request extends AbstractModel
{
    /**
     * NicId 网卡ID。
     */
    public ?string $nicId = null;
}
