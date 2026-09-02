<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeEipsRequest extends AbstractModel
{
    /**
     * EipIds 按照 EIP 的唯一 ID 过滤。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * RegionId 按照 EIP 所属节点ID过滤。
     */
    public ?string $regionId = null;

    /**
     * Name 按照 EIP 的显示名称过滤，该字段支持模糊匹配。
     */
    public ?string $name = null;

    /**
     * Status 按照 EIP 的状态过滤。
     */
    public ?string $status = null;

    /**
     * IsDefault 按照 EIP 的默认属性进行过滤。
     */
    public ?bool $isDefault = null;

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
     * PrivateIpAddress 按照 EIP 绑定的内网 IP 过滤。
     */
    public ?string $privateIpAddress = null;

    /**
     * IpAddress 按照 EIP 的 IP 过滤。
     */
    public ?string $ipAddress = null;

    /**
     * IpAddresses 按照 EIP 的 IP列表过滤。
     *
     * @var list<string>|null
     */
    public ?array $ipAddresses = null;

    /**
     * InstanceId 按照 EIP 绑定的实例 ID 过滤。
     * 该字段过滤出该实例所绑定的网卡上的 EIP。
     */
    public ?string $instanceId = null;

    /**
     * AssociatedId 按照 EIP 绑定的资源 ID 过滤。
     */
    public ?string $associatedId = null;

    /**
     * CidrIds 按照 EIP 所属的CIDR ID列表 过滤。
     *
     * @var list<string>|null
     */
    public ?array $cidrIds = null;

    /**
     * ResourceGroupId 按照 EIP 所属的资源组ID过滤。
     */
    public ?string $resourceGroupId = null;

    /**
     * TagKeys 根据标签键进行搜索。
     * 最长不得超过20个标签键。
     *
     * @var list<string>|null
     */
    public ?array $tagKeys = null;

    /**
     * Tags 根据标签进行搜索。
     * 最长不得超过20个标签。
     *
     * @var list<Tag>|null
     */
    public ?array $tags = null;

    /**
     * InternetChargeType 按照 EIP 的网络计费方式过滤。
     */
    public ?string $internetChargeType = null;

    /**
     * PrefixLength 按照 EIP 的掩码长度过滤。
     * 32 表示单 IP，20–31 表示网段。
     */
    public ?int $prefixLength = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'eipIds' => 'string',
        'ipAddresses' => 'string',
        'cidrIds' => 'string',
        'tagKeys' => 'string',
    ];
}
