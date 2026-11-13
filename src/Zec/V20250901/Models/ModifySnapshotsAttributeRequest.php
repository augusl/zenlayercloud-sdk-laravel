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
 * ModifySnapshotsAttributeRequest
 */
class ModifySnapshotsAttributeRequest extends AbstractModel
{
    /**
     * SnapshotIds 快照ID列表。
     * 可通过调用 **DescribeSnapshots** 获取。
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
     * 需要永久保留时，请设置`isPermanent`=`true`。
     * 指定该时间时，必须晚于当前时间24小时。
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
