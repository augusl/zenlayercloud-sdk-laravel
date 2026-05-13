<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceInfo 描述虚拟机实例的信息。包括规格，状态，网卡等。
 */
class InstanceInfo extends AbstractModel
{
    /**
     * InstanceId 实例唯一ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceName 实例显示名称。
     */
    public ?string $instanceName = null;

    /**
     * ZoneId 实例所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType CPU 规格。
     * 如果是GPU实例，该字段取值为null。
     */
    public ?string $instanceType = null;

    /**
     * Cpu CPU 核数。
     * 单位：个。
     */
    public ?int $cpu = null;

    /**
     * Memory 内存容量。
     * 单位：GiB。
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
     * TimeZone 设置的系统时区信息。
     */
    public ?string $timeZone = null;

    /**
     * NicNetworkType 网卡模式。
     */
    public ?string $nicNetworkType = null;

    /**
     * Status 实例状态。
     */
    public ?string $status = null;

    /**
     * SystemDisk 系统盘信息。
     */
    public ?SystemDisk $systemDisk = null;

    /**
     * DataDisks 实例上挂载的数据盘信息。
     *
     * @var DataDisk[]|null
     */
    public ?array $dataDisks = null;

    /**
     * PublicIpAddresses 实例上公网IPv4列表。
     */
    public ?array $publicIpAddresses = null;

    /**
     * PrivateIpAddresses 实例上内网IP列表。
     */
    public ?array $privateIpAddresses = null;

    /**
     * KeyId 安装的SSH密钥ID。
     */
    public ?string $keyId = null;

    /**
     * SubnetId 实例主网卡关联的子网ID。
     */
    public ?string $subnetId = null;

    /**
     * SecurityGroupId 实例主网卡关联的安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * EnableAgent 是否开启QGA Agent。
     */
    public ?bool $enableAgent = null;

    /**
     * EnableAgentMonitor 是否开启QGA 监控采集。
     */
    public ?bool $enableAgentMonitor = null;

    /**
     * EnableIpForward 是否开启IP转发。
     */
    public ?bool $enableIpForward = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * ExpiredTime 到期时间。
     */
    public ?string $expiredTime = null;

    /**
     * ResourceGroupId 实例所属的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 实例所属的资源组名称。
     */
    public ?string $resourceGroupName = null;

    /**
     * Nics 实例上绑定的网卡信息。
     *
     * @var NicInfo[]|null
     */
    public ?array $nics = null;

    /**
     * Tags 实例关联的标签。
     */
    public ?Tags $tags = null;

    /**
     * LoadBalancerIds 实例上绑定的负载均衡ID列表。
     */
    public ?array $loadBalancerIds = null;

    /**
     * PlacementGroupId 实例所属的置放组ID。
     */
    public ?string $placementGroupId = null;

    /**
     * InstanceOptions 实例选项配置。
     */
    public ?InstanceOptions $instanceOptions = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataDisks' => DataDisk::class,
        'nics' => NicInfo::class,
    ];
}
