<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeSnapshotsRequest
 */
class DescribeSnapshotsRequest extends AbstractModel
{
    /**
     * SnapshotIds 根据快照ID列表进行过滤。
     */
    public ?array $snapshotIds = null;

    /**
     * ZoneId 快照所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * Status 根据快照的状态过滤。
     */
    public ?string $status = null;

    /**
     * DiskIds 按照快照所属的Disk ID列表 过滤。
     */
    public ?array $diskIds = null;

    /**
     * DiskType 根据快照的云盘类型过滤。
     */
    public ?string $diskType = null;

    /**
     * SnapshotType 根据快照类型过滤。
     */
    public ?string $snapshotType = null;

    /**
     * SnapshotName 根据快照显示名称过滤。
     * 该字段支持模糊搜索。
     */
    public ?string $snapshotName = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /**
     * ResourceGroupId 根据资源组ID过滤。
     */
    public ?string $resourceGroupId = null;
}
