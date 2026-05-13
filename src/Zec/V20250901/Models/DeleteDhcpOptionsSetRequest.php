<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteDhcpOptionsSetRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetId DHCP 选项集ID。
     */
    public ?string $dhcpOptionsSetId = null;
}
