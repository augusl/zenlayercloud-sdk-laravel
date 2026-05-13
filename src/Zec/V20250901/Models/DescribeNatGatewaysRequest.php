<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeNatGatewaysRequest extends AbstractModel
{
    /**
     * RegionId 节点ID。
     */
    public ?string $regionId = null;

    /**
     * VpcId 根据NAT网关所属的VPC网络 ID过滤。
     */
    public ?string $vpcId = null;

    /**
     * NatGatewayIds NAT网关ID集合。
     * 实例ID数量上限为100个。
     */
    public ?array $natGatewayIds = null;

    /**
     * Name NAT网关名称。
     */
    public ?string $name = null;

    /**
     * Status NAT网关状态。
     */
    public ?string $status = null;

    /**
     * SecurityGroupId 根据NAT网关所属的安全组ID过滤。
     */
    public ?string $securityGroupId = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页页码。
     */
    public ?int $pageNum = null;

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
