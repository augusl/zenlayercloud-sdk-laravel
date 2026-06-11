<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * HaVipInfo 高可用虚拟IP信息。
 */
class HaVipInfo extends AbstractModel
{
    /**
     * HaVipId 高可用虚拟IP的ID。
     */
    public ?string $haVipId = null;

    /**
     * Name 高可用虚拟IP名称。
     */
    public ?string $name = null;

    /**
     * RegionId HaVip所在节点的ID。
     */
    public ?string $regionId = null;

    /**
     * VpcId 所属VPC的ID。
     */
    public ?string $vpcId = null;

    /**
     * SubnetId 所属子网ID。
     */
    public ?string $subnetId = null;

    /**
     * SecurityGroupId 安全组ID。
     */
    public ?string $securityGroupId = null;

    /**
     * IpAddress 高可用虚拟IP的私网IPv4地址。
     */
    public ?string $ipAddress = null;

    /**
     * AssociatedInstances 关联的实例ID列表。
     */
    public ?array $associatedInstances = null;

    /**
     * MasterInstanceId 当前持有该VIP流量的主实例ID。未绑定实例或无主实例时为null。
     */
    public ?string $masterInstanceId = null;

    /**
     * AssociatedEips 绑定的弹性公网IP列表。未绑定时返回空列表。
     *
     * @var HaVipEipAttachment[]|null
     */
    public ?array $associatedEips = null;

    /**
     * CreateTime 创建时间。
     */
    public ?string $createTime = null;

    /**
     * Tags 标签列表。
     */
    public ?Tags $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'associatedEips' => HaVipEipAttachment::class,
    ];
}
