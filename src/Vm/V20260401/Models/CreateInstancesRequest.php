<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateInstancesRequest extends AbstractModel
{
    /**
     * ZoneId 实例所在节点ID。
     */
    public ?string $zoneId = null;

    /**
     * ImageId 指定有效的镜像ID。
     */
    public ?string $imageId = null;

    /**
     * InstanceType 实例机型。
     */
    public ?string $instanceType = null;

    /**
     * InstanceName 实例显示名称。
     */
    public ?string $instanceName = null;

    /**
     * Password 实例的密码。
     */
    public ?string $password = null;

    /**
     * KeyId 密钥ID。
     */
    public ?string $keyId = null;

    /**
     * ResourceGroupId 实例所在的资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * InstanceChargeType 付费类型。
     * PREPAID：预付费，即包年包月。
     * POSTPAID：后付费。
     */
    public ?string $instanceChargeType = null;

    /**
     * InstanceChargePrepaid 预付费模式，即包年包月相关参数设置。
     * 若指定实例的付费模式为预付费则该参数必传。
     */
    public ?ChargePrepaid $instanceChargePrepaid = null;

    /**
     * InstanceChargePostpaid 后付费模式相关参数设置。
     */
    public ?ChargePostpaid $instanceChargePostpaid = null;

    /**
     * InternetChargeType 网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * TrafficPackageSize 流量包订购大小，单位TB。
     */
    public ?float $trafficPackageSize = null;

    /**
     * InternetMaxBandwidthOut 公网出带宽上限，单位Mbps。
     */
    public ?int $internetMaxBandwidthOut = null;

    /**
     * InstanceCount 指定创建实例的数量。
     */
    public ?int $instanceCount = null;

    /**
     * SystemDisk 实例系统盘配置信息。
     */
    public ?SystemDisk $systemDisk = null;

    /**
     * DataDisks 实例数据盘配置信息。
     *
     * @var DataDisk[]|null
     */
    public ?array $dataDisks = null;

    /**
     * SubnetId 私有网络子网ID。
     */
    public ?string $subnetId = null;

    /**
     * EnableIpv6 是否开启公网IPv6。
     */
    public ?bool $enableIpv6 = null;

    /**
     * EnableIpv4 是否开启公网IPv4。
     */
    public ?bool $enableIpv4 = null;

    /**
     * CpuPassThrough 是否开启CPU穿透。
     */
    public ?bool $cpuPassThrough = null;

    /**
     * InitScript 初始化脚本。
     */
    public ?string $initScript = null;

    /**
     * NetworkMode 网卡模式。
     * Vf：物理直通模式。
     * Virtio：软件模拟模式。
     */
    public ?string $networkMode = null;

    /**
     * DiskPreAllocated 硬盘数据预分配。
     */
    public ?bool $diskPreAllocated = null;

    /**
     * Nic 网卡配置。
     */
    public ?Nic $nic = null;

    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * ClusterId 带宽组ID。
     */
    public ?string $clusterId = null;

    /**
     * CidrBlockId CIDR 地址块ID。指定该字段将从CIDR 地址块里分配公网IP
     */
    public ?string $cidrBlockId = null;

    /**
     * StartCidrIpv4 CIDR地址段内的起始IP地址。
     * 该字段需要配额`cidrBlockId`一起使用，该字段代表将从该地址起始从地址段中给机器分配公网IP。
     */
    public ?string $startCidrIpv4 = null;

    /**
     * MarketingOptions 市场营销活动相关信息。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 创建实例时关联的标签。
     * 注意：关联标签键不能重复。
     */
    public ?TagAssociation $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataDisks' => DataDisk::class,
    ];
}
