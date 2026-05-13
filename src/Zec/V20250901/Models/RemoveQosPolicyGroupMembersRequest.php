<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class RemoveQosPolicyGroupMembersRequest extends AbstractModel
{
    /**
     * QosPolicyGroupId QoS策略组ID。
     */
    public ?string $qosPolicyGroupId = null;

    /**
     * ResourceIds 要移出策略组的成员资源ID列表。
     * 不传则移除该策略组的全部成员。
     */
    public ?array $resourceIds = null;
}
