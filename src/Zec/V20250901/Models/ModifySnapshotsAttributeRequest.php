<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifySnapshotsAttributeRequest extends AbstractModel
{
    /**
     * SnapshotIds 快照ID列表。
     *
     * @var list<string>|null
     */
    public ?array $snapshotIds = null;

    /**
     * SnapshotName 快照名称。
     */
    public ?string $snapshotName = null;

    /**
     * RetentionTime 快照过期时间。
     * 格式为：yyyy-MM-ddTHH:mm:ssZ。
     * 如果改成永久保留，请设置`isPermanent`=`true`，如果设置该时间必须设置为当前时间后24小时。
     */
    public ?string $retentionTime = null;

    /**
     * IsPermanent 该定期快照策略创建的快照是否永久保留。
     */
    public ?bool $isPermanent = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'snapshotIds' => 'string',
    ];
}
