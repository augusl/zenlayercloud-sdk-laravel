<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeInstancesRequest extends AbstractModel
{
    /**
     * InstanceIds 虚拟机实例ID。
     * 最多支持100个ID查询。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * ZoneId 实例所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InternetChargeType 网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * ImageId 镜像ID。
     */
    public ?string $imageId = null;

    /**
     * InstanceType 实例机型。
     * 具体取值可通过调用接口DescribeZoneInstanceConfigInfos来获得最新的规格表。
     */
    public ?string $instanceType = null;

    /**
     * KeyId 密钥ID。
     */
    public ?string $keyId = null;

    /**
     * PublicIpAddresses 公网IPv4地址。
     *
     * @var list<string>|null
     */
    public ?array $publicIpAddresses = null;

    /**
     * PrivateIpAddresses 子网内网的IPv4地址。
     *
     * @var list<string>|null
     */
    public ?array $privateIpAddresses = null;

    /**
     * InstanceStatus 实例状态。
     */
    public ?string $instanceStatus = null;

    /**
     * InstanceName 实例显示名称。
     * 如果该值以*结尾，则对instanceName进行模糊匹配，否则将进行精确匹配。
     */
    public ?string $instanceName = null;

    /**
     * SubnetId 虚拟子网ID。
     */
    public ?string $subnetId = null;

    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * PageNum 返回的分页数。
     * 默认为1。
     */
    public ?int $pageNum = null;

    /**
     * ResourceGroupId 资源组的ID。
     * 如果不传，则返回该用户可见的所有资源组内的实例。
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

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'instanceIds' => 'string',
        'publicIpAddresses' => 'string',
        'privateIpAddresses' => 'string',
        'tagKeys' => 'string',
    ];
}
