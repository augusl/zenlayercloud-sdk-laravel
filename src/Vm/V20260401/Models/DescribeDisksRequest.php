<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeDisksRequest extends AbstractModel
{
    /**
     * DiskIds 云硬盘ID集合。
     */
    public ?array $diskIds = null;

    /**
     * DiskName 云硬盘名称。
     */
    public ?string $diskName = null;

    /**
     * DiskStatus 云硬盘状态。
     */
    public ?string $diskStatus = null;

    /**
     * DiskType 云硬盘类型。
     * SYSTEM：系统盘。
     * DATA：数据盘。
     */
    public ?string $diskType = null;

    /**
     * DiskCategory 云硬盘种类。
     * STANDARD：标准云盘。
     * SSD：固态硬盘。
     */
    public ?string $diskCategory = null;

    /**
     * DiskSize 云硬盘大小，单位GB。
     */
    public ?int $diskSize = null;

    /**
     * Portable 是否可拔插。
     * false代表会随实例一起删除。
     * true代表不会随实例一起删除。
     */
    public ?bool $portable = null;

    /**
     * InstanceId 实例ID。
     */
    public ?string $instanceId = null;

    /**
     * ZoneId 可用区ID。
     * 可从DescribeZones接口中获取。
     */
    public ?string $zoneId = null;

    /**
     * PageNum 返回的分页数。
     * 默认为1。
     */
    public ?int $pageNum = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * TagKeys 根据标签键进行搜索。
     * 最长不得超过20个标签键。
     */
    public ?array $tagKeys = null;

    /**
     * Tags 根据标签进行搜索。
     * 最长不得超过20个标签。
     *
     * @var Tag[]|null
     */
    public ?array $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];
}
