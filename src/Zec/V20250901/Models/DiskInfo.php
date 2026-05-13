<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DiskInfo 描述云盘的基本信息。
 */
class DiskInfo extends AbstractModel
{
    /**
     * DiskId 云盘的 ID。
     */
    public ?string $diskId = null;

    /**
     * DiskName 云盘的名称。
     */
    public ?string $diskName = null;

    /**
     * RegionId 云盘所在的节点ID。
     */
    public ?string $regionId = null;

    /**
     * ZoneId 云盘所在节点的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * DiskType 云盘的类型。
     */
    public ?string $diskType = null;

    /**
     * Portable 是否可卸载。
     */
    public ?bool $portable = null;

    /**
     * DiskCategory 云盘的类别。
     */
    public ?string $diskCategory = null;

    /**
     * DiskSize 云盘的大小。
     * 单位：GiB。
     */
    public ?int $diskSize = null;

    /**
     * DiskStatus 云盘的状态。
     */
    public ?string $diskStatus = null;

    /**
     * InstanceId 云盘绑定实例的ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceName 云盘绑定实例的名称。
     */
    public ?string $instanceName = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * ExpiredTime 到期时间。
     */
    public ?string $expiredTime = null;

    /**
     * Period 周期。
     */
    public ?int $period = null;

    /**
     * ResourceGroupId 云盘所属的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 云盘所属的资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * Serial 云盘序号。
     * 可能为null，表示取不到值。
     */
    public ?string $serial = null;

    /**
     * SnapshotAbility 是否具体快照能力。
     */
    public ?bool $snapshotAbility = null;

    /**
     * AutoSnapshotPolicyId 云盘关联的自动快照策略ID。
     */
    public ?string $autoSnapshotPolicyId = null;

    /**
     * Tags 该云盘关联的标签。
     */
    public ?Tags $tags = null;

    /**
     * BurstingEnabled 是否开启 Burst。
     */
    public ?bool $burstingEnabled = null;
}
