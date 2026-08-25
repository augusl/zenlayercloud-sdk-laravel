<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

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
     *
     * @var list<string>|null
     */
    public ?array $resourceIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'resourceIds' => 'string',
    ];
}
