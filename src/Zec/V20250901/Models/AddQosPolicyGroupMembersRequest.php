<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * AddQosPolicyGroupMembersRequest
 */
class AddQosPolicyGroupMembersRequest extends AbstractModel
{
    /**
     * QosPolicyGroupId QoS策略组ID。
     * 可通过调用 ~~DescribeQosPolicyGroups~~ 获取。
     */
    public ?string $qosPolicyGroupId = null;

    /**
     * Members 要加入策略组的成员列表。
     *
     * @var list<QosPolicyGroupMember>|null
     */
    public ?array $members = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'members' => QosPolicyGroupMember::class,
    ];
}
