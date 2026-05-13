<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateNetworkInterfaceRequest
 */
class CreateNetworkInterfaceRequest extends AbstractModel
{
    /**
     * Name 网卡名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $name = null;

    /**
     * SubnetId 子网的ID。
     */
    public ?string $subnetId = null;

    /**
     * NicStackType 网卡的IP堆栈类型。
     * 如果不指定，会根据子网堆栈类型决定：如果子网是V4,则网卡为V4，如果子网是V6,则网卡为V6。
     * 如果网卡要V4&V6，请指定该参数。
     */
    public ?string $nicStackType = null;

    /**
     * ResourceGroupId 网卡创建所在的资源组ID，如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * SecurityGroupId 指定安全组ID。
     * 目前一个网卡只能关联1个安全组。
     * 如果未指定，会默认用VPC关联下的安全组。
     */
    public ?string $securityGroupId = null;

    /**
     * InternetChargeType 公网IPv6的网络计费方式。
     * 当子网的堆栈类型包括V6且为公网时，需要指定。
     */
    public ?string $internetChargeType = null;

    /**
     * Bandwidth 公网IPv6的带宽限速。
     * 单位Mbps。
     * 当子网的堆栈类型包括V6且为公网时，需要指定。
     */
    public ?int $bandwidth = null;

    /**
     * PackageSize 公网IPv6的流量包大小。
     * 单位为TB。
     * 值要求为0或0.1的倍数。
     * 当子网的堆栈类型包括V6且为公网时，且网络计费方式是流量计费(`ByTrafficPackage`)需要指定。
     */
    public ?float $packageSize = null;

    /**
     * ClusterId 公网IPv6所指定的共享带宽包ID。
     * 当子网的堆栈类型包括V6且为公网时，且网络计费方式是共享带宽包计费(`BandwidthCluster`)需要指定。
     */
    public ?string $clusterId = null;

    /**
     * MarketingOptions 市场营销相关的选项。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 创建网卡时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;
}
