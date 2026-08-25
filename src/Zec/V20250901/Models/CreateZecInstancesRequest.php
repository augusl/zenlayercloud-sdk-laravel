<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateZecInstancesRequest
 */
class CreateZecInstancesRequest extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * ImageId 指定有效的镜像ID。
     * 可以通过[DescribeImages](../image/describeimages.md)取返回信息中的imageId字段。
     */
    public ?string $imageId = null;

    /**
     * TimeZone 设置操作系统的时区。
     * 如果未指定，将使用区域所在的时区。
     */
    public ?string $timeZone = null;

    /**
     * InstanceType 实例机型。普通实例取值可通过[DescribeZoneInstanceConfigInfos](describezoneinstanceconfiginfos.md)获得；GPU 实例取值可通过[DescribeZoneGpuInstanceConfigInfos](describezonegpuinstanceconfiginfos.md)获得。
     */
    public ?string $instanceType = null;

    /**
     * InstanceName 实例显示名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     * 购买多台实例，可以指定模式串[begin_number,bits]。
     * begin_number：有序数值的起始值，取值支持[0,99999]，默认值为0。
     * bits：有序数值所占的位数，取值支持[1,6]，默认值为6。
     * 注意模式串中不得有空格。
     * 购买1台时，例如server-[3,3]实例显示为server003；购买2台时，实例显示名分别为server003，server004。
     * 支持指定多个模式串，如server-[3,3]-[1,1]。
     * 默认值为 instance。
     */
    public ?string $instanceName = null;

    /**
     * Password 实例的密码。
     * 与keyId必须指定其中的一种（Windows和Generic类型的镜像无法指定密码和key）。
     * 必须包含以下3种格式的字符：大小写字母: [a-zA-Z]数字: 0-9特殊字符: ~!@$^*-_=+。
     */
    public ?string $password = null;

    /**
     * KeyId 密钥ID。
     * 与password必须指定其中的一种（Windows和Generic类型的镜像无法指定密码和key）。
     * 可调用接口DescribeKeyPairs来获得最新的密钥对信息。
     * 关联密钥后，就可以通过对应的私钥来访问实例；密钥与密码不能同时指定，同时Windows操作系统不支持指定密钥。
     * 示例值：key-YWD2QFOl。
     */
    public ?string $keyId = null;

    /**
     * NicNetworkType 网卡模式。
     */
    public ?string $nicNetworkType = null;

    /**
     * InstanceCount 要创建的实例数量。
     */
    public ?int $instanceCount = null;

    /**
     * SystemDisk 实例系统盘配置信息。
     * 若不指定该参数，则按照系统默认值进行分配。
     * 即操作系统要求的最小大小。
     */
    public ?SystemDisk $systemDisk = null;

    /**
     * DataDisks 实例数据盘配置信息。若不指定该参数，则默认不额外购买数据盘。列表中每一项对应一块独立的数据盘，数据盘总数量受团队配额限制。
     *
     * @var list<DataDisk>|null
     */
    public ?array $dataDisks = null;

    /**
     * SecurityGroupId 要配置在实例主网卡的安全组ID。
     * 目前只能关联1个安全组。
     * 如果未指定，会默认用VPC关联的安全组。
     */
    public ?string $securityGroupId = null;

    /**
     * SubnetId 子网ID。
     */
    public ?string $subnetId = null;

    /**
     * LanIp 分配的内网起始IP。
     * 如果内网IP被使用,则会往后分配。
     */
    public ?string $lanIp = null;

    /**
     * EnableAgent 是否安装启动Agent。
     */
    public ?bool $enableAgent = null;

    /**
     * EnableIpForward 是否开启IP转发。
     */
    public ?bool $enableIpForward = null;

    /**
     * InternetChargeType 公网IP的网络计费类型。
     * 如果不指定，则不会分配公网IP地址。
     */
    public ?string $internetChargeType = null;

    /**
     * TrafficPackageSize 流量包订购大小。
     * 单位为TB。
     * 该值必须在`internetChargeType = ByTrafficPackage`时才会生效。
     * 当`IpStackType` = `IPv4_IPv6`时，流量包大小作用于IPv4。
     */
    public ?float $trafficPackageSize = null;

    /**
     * Bandwidth 公网出带宽上限。
     * 单位：Mbps。
     * 当分配公网IP时需要指定。
     */
    public ?int $bandwidth = null;

    /**
     * EipBindType 公网IP的绑定模式。
     * 当分配公网IP时需要指定。
     * 绑定网段(Block)型EIP时只能使用`Passthrough`，必须显式指定（不能省略，省略等价于`FullNat`会被拒绝）。
     */
    public ?string $eipBindType = null;

    /**
     * EipIds 分配已有的EIP到实例上。
     * IP数量必须和创建的实例数量一致。
     * 如果指定该字段，则不会新建EIP, 相关字段将无效（`networkLineType`)。
     * 请确保创建的网卡`ipStackType` 包含`IPv4`。
     *
     * @var list<string>|null
     */
    public ?array $eipIds = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type 公网IPv4的线路类型。
     * 当分配公网IP时需要指定。
     * 请确保所选子网的堆栈类型支持`IPv4`。
     * 已废弃，请使用`networkLineType`。
     *
     * @deprecated
     */
    public ?string $eipV4Type = null;

    /**
     * IpStackType 设置IP堆栈类型。
     * 如果不指定，当子网堆栈类型IPv4或IPv4_IPv6时，默认使用IPv4。
     */
    public ?string $ipStackType = null;

    /**
     * NetworkLineType 公网IPv4的线路类型。
     * 当分配公网IP时需要指定。
     * 请确保所选子网的堆栈类型支持`IPv4`。
     */
    public ?string $networkLineType = null;

    /**
     * ClusterId 公网IPv4/IPv6加入的共享带宽包ID。
     * 当网络计费方式是共享带宽包计费(`BandwidthCluster`)时需要指定。
     */
    public ?string $clusterId = null;

    /**
     * Ipv6ClusterId 公网IPv6加入的共享带宽包ID。
     * 网络计费方式是共享带宽包计费(`BandwidthCluster`)时且`ipStackType`设定为IPv4_IPv6时需要指定。
     * 如果不指定，则默认使用`clusterId`。
     * 该字段一般用于IPv4/IPv6所属不同共享带宽包。
     */
    public ?string $ipv6ClusterId = null;

    /**
     * ResourceGroupId 创建后实例所在的资源组ID，如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * MarketingOptions 市场营销的相关选项。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 创建实例时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /**
     * UserData 初始化命令。
     */
    public ?string $userData = null;

    /**
     * InstanceOptions 实例选项配置。
     */
    public ?InstanceOptions $instanceOptions = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataDisks' => DataDisk::class,
    ];

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'eipIds' => 'string',
    ];
}
