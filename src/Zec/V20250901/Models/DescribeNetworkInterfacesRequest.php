<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeNetworkInterfacesRequest extends AbstractModel
{
    /**
     * NicIds 根据网卡ID过滤。
     * 最多传入100个ID。
     */
    public ?array $nicIds = null;

    /**
     * Name 根据网卡所属的名称过滤。
     * 该字段支持模糊搜索。
     */
    public ?string $name = null;

    /**
     * RegionId 根据网卡所属的节点 ID过滤。
     */
    public ?string $regionId = null;

    /**
     * VpcId 根据网卡所属的VPC ID过滤。
     */
    public ?string $vpcId = null;

    /**
     * SubnetId 根据网卡所属的子网ID过滤。
     */
    public ?string $subnetId = null;

    /**
     * InstanceId 网卡关联的实例ID过滤。
     */
    public ?string $instanceId = null;

    /**
     * Status 根据网卡的状态过滤。
     */
    public ?string $status = null;

    /**
     * PageSize 返回的分页大小。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     */
    public ?int $pageNum = null;

    /**
     * NicType 根据网卡的类型筛选过滤。
     */
    public ?string $nicType = null;

    /**
     * ResourceGroupId 根据网卡所属的资源组ID过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * SecurityGroupId 根据网卡所属的安全组ID过滤。
     */
    public ?string $securityGroupId = null;

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

    /**
     * NicSubnetType 根据网卡堆栈类型筛选。
     * 枚举值：IPv4 / IPv4_IPv6 / IPv6。
     * 配合subnetId使用可查出子网内持有IPv6的全部网卡。
     */
    public ?string $nicSubnetType = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];
}
