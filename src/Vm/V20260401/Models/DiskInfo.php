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
 * DiskInfo 云硬盘信息。
 */
class DiskInfo extends AbstractModel
{
    /**
     * DiskId 云硬盘ID。
     */
    public ?string $diskId = null;

    /**
     * DiskName 云硬盘名称。
     */
    public ?string $diskName = null;

    /**
     * ZoneId 云盘所属区域。
     */
    public ?string $zoneId = null;

    /**
     * DiskType 云盘类型。
     * SYSTEM：系统盘。
     * DATA：数据盘。
     */
    public ?string $diskType = null;

    /**
     * Portable 是否可拔插。
     */
    public ?bool $portable = null;

    /**
     * DiskCategory 云硬盘种类。
     * STANDARD：标准云盘。
     * SSD：固态硬盘。
     */
    public ?string $diskCategory = null;

    /**
     * DiskSize 云盘大小，单位GB。
     */
    public ?int $diskSize = null;

    /**
     * DiskStatus 云盘状态。
     */
    public ?string $diskStatus = null;

    /**
     * InstanceId 所绑定的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceName 所绑定的实例名字。
     */
    public ?string $instanceName = null;

    /**
     * ChargeType 付费类型。
     * PREPAID：预付费。
     * POSTPAID：后付费。
     */
    public ?string $chargeType = null;

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
     * Period 购买实例的时长，单位：月。
     * 后付费实例该字段为null。
     */
    public ?int $period = null;

    /**
     * AutoRenew 是否自动续费。
     * 对于预付费实例，取消订阅后，该字段值将返回false。
     */
    public ?bool $autoRenew = null;

    /**
     * Tags 资源关联的标签信息。
     */
    public ?Tags $tags = null;
}
