<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CancelAutoSnapshotPolicyRequest extends AbstractModel
{
    /**
     * AutoSnapshotPolicyId 自动快照策略ID。
     */
    public ?string $autoSnapshotPolicyId = null;

    /**
     * DiskIds 要移除的磁盘ID列表。
     *
     * @var list<string>|null
     */
    public ?array $diskIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskIds' => 'string',
    ];
}
