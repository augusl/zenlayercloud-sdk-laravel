<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * SnapshotInfo 描述快照的信息。
 */
class SnapshotInfo extends AbstractModel
{
    /**
     * SnapshotId 快照唯一ID。
     */
    public ?string $snapshotId = null;

    /**
     * SnapshotName 快照显示名称。
     */
    public ?string $snapshotName = null;

    /**
     * ZoneId 快照所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * Status 快照的状态。
     */
    public ?string $status = null;

    /**
     * SnapshotType 快照的类型。
     */
    public ?string $snapshotType = null;

    /**
     * RetentionTime 快照的保留到期时间。
     * 如果取不到值，说明快照为永久保留。
     */
    public ?string $retentionTime = null;

    /**
     * DiskId 云盘ID。
     */
    public ?string $diskId = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * DiskAbility 是否具备创建disk的能力。
     */
    public ?bool $diskAbility = null;

    /**
     * ResourceGroup 所属的资源组信息。
     */
    public ?ResourceGroupInfo $resourceGroup = null;
}
