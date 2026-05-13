<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class AddQosPolicyGroupMembersRequest extends AbstractModel
{
    /**
     * QosPolicyGroupId QoS策略组ID。
     */
    public ?string $qosPolicyGroupId = null;

    /**
     * Members 要加入策略组的成员列表。
     *
     * @var QosPolicyGroupMember[]|null
     */
    public ?array $members = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'members' => QosPolicyGroupMember::class,
    ];
}
