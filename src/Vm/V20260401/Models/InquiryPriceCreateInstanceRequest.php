<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceCreateInstanceRequest extends AbstractModel
{
    /**
     * ZoneId 实例所属的可用区ID。
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
     * InstanceChargeType 实例计费类型。
     * PREPAID：预付费。
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
     * SystemDisk 系统盘配置。
     */
    public ?SystemDisk $systemDisk = null;

    /**
     * DataDisks 数据盘配置。
     *
     * @var DataDisk[]|null
     */
    public ?array $dataDisks = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataDisks' => DataDisk::class,
    ];
}
