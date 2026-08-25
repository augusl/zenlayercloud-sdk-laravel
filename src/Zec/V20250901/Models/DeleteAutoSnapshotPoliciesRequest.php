<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteAutoSnapshotPoliciesRequest extends AbstractModel
{
    /**
     * AutoSnapshotPolicyIds 要删除的自动快照策略ID列表。
     *
     * @var list<string>|null
     */
    public ?array $autoSnapshotPolicyIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'autoSnapshotPolicyIds' => 'string',
    ];
}
