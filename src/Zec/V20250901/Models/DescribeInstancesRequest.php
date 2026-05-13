<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeInstancesRequest
 */
class DescribeInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 根据实例ID列表进行筛选。
     * 最大不能超过100个。
     */
    public ?array $instanceIds = null;

    /**
     * ZoneId 实例所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * ImageId 镜像ID。
     */
    public ?string $imageId = null;

    /**
     * Ipv4Address 根据实例关联的IPv4过滤。
     */
    public ?string $ipv4Address = null;

    /**
     * Ipv6Address 根据实例关联的IPv6信息过滤。
     */
    public ?string $ipv6Address = null;

    /**
     * Status 根据实例的状态过滤。
     */
    public ?string $status = null;

    /**
     * Name 根据实例显示名称过滤。
     * 该字段支持模糊搜索。
     */
    public ?string $name = null;

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
