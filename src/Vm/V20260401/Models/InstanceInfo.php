<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceInfo 实例相关信息。
 */
class InstanceInfo extends AbstractModel
{
    /**
     * InstanceId 实例唯一ID。
     */
    public ?string $instanceId = null;

    /**
     * ZoneId 实例所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceName 实例显示名称。
     */
    public ?string $instanceName = null;

    /**
     * InstanceType 实例机型ID。
     */
    public ?string $instanceType = null;

    /**
     * CpuCount CPU核数，单位：核。
     */
    public ?int $cpuCount = null;

    /**
     * Memory 实例内存容量，单位：GiB。
     */
    public ?int $memory = null;

    /**
     * ImageId 镜像ID。
     */
    public ?string $imageId = null;

    /**
     * ImageName 镜像名称。
     */
    public ?string $imageName = null;

    /**
     * InstanceChargeType 实例计费类型。
     * PREPAID：预付费，即包年包月。
     * POSTPAID：后付费。
     */
    public ?string $instanceChargeType = null;

    /**
     * InternetMaxBandwidthOut 公网出口带宽，单位：Mbps。
     * 0代表无限制，但是不会超过机型的最大上限。
     */
    public ?int $internetMaxBandwidthOut = null;

    /**
     * InternetChargeType 网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * Period 购买实例的时长，单位：月。
     * 后付费实例该字段为null。
     */
    public ?int $period = null;

    /**
     * PublicIpAddresses 实例公网IPv4列表。
     * 如果机器的主IP未加入到公网组网接口，那么主IP将无法使用，且该字段也不会返回该IP。
     *
     * @var list<string>|null
     */
    public ?array $publicIpAddresses = null;

    /**
     * PublicIpv6Addresses 实例公网IPv6列表。
     *
     * @var list<string>|null
     */
    public ?array $publicIpv6Addresses = null;

    /**
     * PrivateIpAddresses 实例内网IP列表。
     *
     * @var list<string>|null
     */
    public ?array $privateIpAddresses = null;

    /**
     * SubnetId 实例所属的内网子网ID。
     */
    public ?string $subnetId = null;

    /**
     * CreateTime 创建时间。
     * 格式为：YYYY-MM-DDThh:mm:ssZ。
     */
    public ?string $createTime = null;

    /**
     * ExpiredTime 到期时间。
     * 格式为：YYYY-MM-DDThh:mm:ssZ。
     */
    public ?string $expiredTime = null;

    /**
     * ResourceGroupId 实例所属资源组的ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 实例所属资源组的名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * InstanceStatus 实例状态。
     */
    public ?string $instanceStatus = null;

    /**
     * TrafficPackageSize 流量包订购大小，单位为TB。
     */
    public ?float $trafficPackageSize = null;

    /**
     * SecurityGroupIds 实例加入的安全组列表。
     *
     * @var list<string>|null
     */
    public ?array $securityGroupIds = null;

    /**
     * SystemDisk 实例系统盘信息。
     */
    public ?SystemDisk $systemDisk = null;

    /**
     * DataDisks 实例数据盘信息。
     *
     * @var list<DataDisk>|null
     */
    public ?array $dataDisks = null;

    /**
     * AutoRenew 是否自动续费。
     * 对于预付费实例，取消订阅后，该字段值将返回false。
     */
    public ?bool $autoRenew = null;

    /**
     * KeyId 密钥ID。
     * 注意：此字段可能返回null，表示取不到有效值。
     */
    public ?string $keyId = null;

    /**
     * Nic 网卡配置。
     */
    public ?Nic $nic = null;

    /**
     * Tags 资源关联的标签信息。
     */
    public ?Tags $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataDisks' => DataDisk::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'publicIpAddresses' => 'string',
        'publicIpv6Addresses' => 'string',
        'privateIpAddresses' => 'string',
        'securityGroupIds' => 'string',
    ];
}
