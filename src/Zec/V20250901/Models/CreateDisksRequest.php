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
 * CreateDisksRequest
 */
class CreateDisksRequest extends AbstractModel
{
    /**
     * InstanceChargePostpaid 后付费云硬盘的承诺周期。
     * 仅在需要指定承诺周期时传递。
     */
    public ?ChargePostpaid $instanceChargePostpaid = null;

    /**
     * ZoneId 云硬盘所属的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * DiskName 云盘名称。
     * 该参数需以数字或字母开头，最多支持64个字符。
     * 仅支持字母、数字、连字符(-)和英文句点(.)。
     */
    public ?string $diskName = null;

    /**
     * DiskNames 每块云硬盘各自的名称。
     * 数量需要与`diskAmount`字段一致，命名规则同`diskName`。
     * 不传则本批次云硬盘均使用`diskName`命名。
     *
     * @var list<string>|null
     */
    public ?array $diskNames = null;

    /**
     * DiskSize 云硬盘大小，单位GiB。
     */
    public ?int $diskSize = null;

    /**
     * DiskAmount 需要创建的云硬盘的数量。
     */
    public ?int $diskAmount = null;

    /**
     * InstanceId 云硬盘挂载的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceIds 要绑定的实例 ID。
     * 数量需要与 `diskAmount` 字段一致。
     *
     * @var list<string>|null
     */
    public ?array $instanceIds = null;

    /**
     * ResourceGroupId 云硬盘所在的资源组ID。
     * 如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * DiskCategory 云硬盘种类。
     * Basic NVMe SSD：经济型 NVMe SSD。
     * Standard NVMe SSD：标准型 NVMe SSD。
     * 默认值：Standard NVMe SSD。
     * 调用 DescribeDiskCategory 获取云硬盘种类。
     */
    public ?string $diskCategory = null;

    /**
     * SnapshotId 使用快照ID进行创建。
     * 如果传入则根据此快照创建云硬盘，快照的云盘类型必须为数据盘快照。
     */
    public ?string $snapshotId = null;

    /**
     * MarketingOptions 市场营销的相关选项。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 创建云硬盘时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;

    /**
     * BurstingEnabled 是否开启性能突发。
     */
    public ?bool $burstingEnabled = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'diskNames' => 'string',
        'instanceIds' => 'string',
    ];
}
