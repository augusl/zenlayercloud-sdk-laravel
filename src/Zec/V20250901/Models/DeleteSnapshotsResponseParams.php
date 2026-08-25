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
 * DeleteSnapshotsResponseParams
 */
class DeleteSnapshotsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SnapshotIds 操作失败的快照ID。
     *
     * @var list<string>|null
     */
    public ?array $snapshotIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'snapshotIds' => 'string',
    ];
}
