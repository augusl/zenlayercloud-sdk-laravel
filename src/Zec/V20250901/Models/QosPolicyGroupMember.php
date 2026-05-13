<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * QosPolicyGroupMember QoS策略组成员信息。
 */
class QosPolicyGroupMember extends AbstractModel
{
    /**
     * ResourceId IP 资源 的ID。
     */
    public ?string $resourceId = null;

    /**
     * IpType IP类型。
     */
    public ?string $ipType = null;
}
