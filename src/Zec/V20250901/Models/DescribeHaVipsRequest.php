<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeHaVipsRequest
 */
class DescribeHaVipsRequest extends AbstractModel
{
    /**
     * HaVipIds HaVip ID列表。
     * 最多支持100个ID查询。
     */
    public ?array $haVipIds = null;

    /**
     * Name HaVip名称，支持模糊查询。
     */
    public ?string $name = null;

    /**
     * RegionId 所在节点ID。
     */
    public ?string $regionId = null;

    /**
     * VpcIds 所属VPC ID列表。
     */
    public ?array $vpcIds = null;

    /**
     * SubnetIds 所属子网ID列表。
     */
    public ?array $subnetIds = null;

    /**
     * IpAddresses 私网IP地址列表。最多支持100个地址查询。
     */
    public ?array $ipAddresses = null;

    /**
     * InstanceIds 实例ID列表，返回绑定了指定实例的高可用虚拟IP。
     */
    public ?array $instanceIds = null;

    /**
     * PageSize 分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 分页页码。
     */
    public ?int $pageNum = null;

    /**
     * TagKeys 根据标签键进行搜索。
     * 最多支持20个标签键。
     */
    public ?array $tagKeys = null;

    /**
     * Tags 根据标签进行搜索。
     * 最多支持20个标签。
     *
     * @var Tag[]|null
     */
    public ?array $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];
}
