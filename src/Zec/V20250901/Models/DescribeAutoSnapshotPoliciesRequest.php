<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeAutoSnapshotPoliciesRequest
 */
class DescribeAutoSnapshotPoliciesRequest extends AbstractModel
{
    /**
     * AutoSnapshotPolicyIds 根据自动快照策略的ID进行过滤。
     */
    public ?array $autoSnapshotPolicyIds = null;

    /**
     * ZoneIds 根据自动快照策略的可用区ID进行过滤。
     */
    public ?array $zoneIds = null;

    /**
     * AutoSnapshotPolicyName 根据自动快照策略的名称进行过滤。
     * 该字段支持模糊搜索。
     */
    public ?string $autoSnapshotPolicyName = null;

    /**
     * ResourceGroupId 根据资源组ID进行过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

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
