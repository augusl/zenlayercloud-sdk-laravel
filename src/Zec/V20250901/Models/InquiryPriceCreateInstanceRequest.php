<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceCreateInstanceRequest extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * InstanceType 实例机型。
     * 具体取值可通过调用接口[DescribeZoneInstanceConfigInfos](describezoneinstanceconfiginfos.md)来获得最新的规格表。
     */
    public ?string $instanceType = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type 公网IPv4的线路类型。
     * 目前不支持三线IP(`ThreeLine`)。
     * 已废弃，请使用`networkLineType`。
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType 公网IPv4的线路类型。
     * 目前不支持三线IP(`ThreeLine`)。
     */
    public ?string $networkLineType = null;

    /**
     * InternetChargeType 公网IP的网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * TrafficPackageSize 流量包订购大小。
     * 单位为TB。
     * 该值必须在`internetChargeType = ByTrafficPackage`时才会生效。
     */
    public ?float $trafficPackageSize = null;

    /**
     * Bandwidth 公网出带宽上限。
     * 单位：Mbps。
     */
    public ?int $bandwidth = null;

    /**
     * InstanceCount 实例数量。
     */
    public ?int $instanceCount = null;

    /**
     * SystemDisk 系统盘相关信息。
     */
    public ?SystemDisk $systemDisk = null;

    /**
     * DataDisk 数据盘相关信息。
     */
    public ?DataDisk $dataDisk = null;
}
