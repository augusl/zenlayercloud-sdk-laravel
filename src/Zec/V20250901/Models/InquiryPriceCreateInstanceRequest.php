<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

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
     * InstanceType 实例机型。普通实例取值可通过[DescribeZoneInstanceConfigInfos](describezoneinstanceconfiginfos.md)获得；GPU 实例取值可通过[DescribeZoneGpuInstanceConfigInfos](describezonegpuinstanceconfiginfos.md)获得。
     */
    public ?string $instanceType = null;

    /**
     * Deprecated: EipV4Type 已废弃，请不要使用。
     * EipV4Type 公网IPv4的线路类型。
     * 已废弃，请使用`networkLineType`。
     *
     * @deprecated
     */
    public ?string $eipV4Type = null;

    /**
     * NetworkLineType 公网IPv4的线路类型。当`internetChargeType`有值时必填。
     */
    public ?string $networkLineType = null;

    /**
     * InternetChargeType 公网IP的网络计费类型。如果不指定，则不会询价公网IP。
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
     * DataDisk 数据盘相关信息。只能配置1块数据盘，配置多块数据盘请使用`dataDisks`；同时指定时以`dataDisks`为准。
     */
    public ?DataDisk $dataDisk = null;

    /**
     * DataDisks 数据盘相关信息，支持传入多块数据盘。
     * 若不指定该参数，则回退使用`dataDisk`。
     *
     * @var list<DataDisk>|null
     */
    public ?array $dataDisks = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataDisks' => DataDisk::class,
    ];
}
