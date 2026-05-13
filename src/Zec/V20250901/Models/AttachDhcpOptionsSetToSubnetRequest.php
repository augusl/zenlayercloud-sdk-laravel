<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class AttachDhcpOptionsSetToSubnetRequest extends AbstractModel
{
    /**
     * DhcpOptionsSetId DHCP 选项集ID。
     */
    public ?string $dhcpOptionsSetId = null;

    /**
     * SubnetIds 要与 DHCP 选项集关联的 Subnet 的 ID集合。
     */
    public ?array $subnetIds = null;
}
