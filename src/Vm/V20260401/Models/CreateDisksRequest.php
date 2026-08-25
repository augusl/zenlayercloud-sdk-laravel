<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateDisksRequest extends AbstractModel
{
    /**
     * ChargeType 付费类型。
     * PREPAID：预付费，即包年包月。
     * POSTPAID：后付费。
     */
    public ?string $chargeType = null;

    /**
     * ChargePrepaid 预付费模式，即包年包月相关参数设置。
     * 若指定云硬盘的付费模式为预付费则该参数必传。
     */
    public ?ChargePrepaid $chargePrepaid = null;

    /**
     * DiskName 云硬盘名称。
     * 必须以数字或字母开头或结尾，长度1-64字符，仅支持字母、数字、-和英文句点(.)。
     */
    public ?string $diskName = null;

    /**
     * DiskSize 云硬盘大小，单位GB。
     */
    public ?int $diskSize = null;

    /**
     * DiskAmount 云硬盘创建数量。
     * 最小值与默认值均为1，最大值50。
     */
    public ?int $diskAmount = null;

    /**
     * InstanceId 创建后需要挂载的实例ID。
     * 指定实例ID将会为实例所在的可用区创建数据盘并挂载到实例上。
     */
    public ?string $instanceId = null;

    /**
     * ZoneId 云硬盘所属的可用区ID。
     * 如果指定了instanceId，则该字段无效。
     */
    public ?string $zoneId = null;

    /**
     * ResourceGroupId 云硬盘所在的资源组ID，如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * DiskCategory 云硬盘种类。
     * STANDARD：标准云盘。
     * SSD：固态硬盘。
     * 默认为SSD。
     */
    public ?string $diskCategory = null;

    /**
     * MarketingOptions 市场营销活动相关信息。
     */
    public ?MarketingInfo $marketingOptions = null;

    /**
     * Tags 创建云硬盘时关联的标签。
     * 注意：关联标签键不能重复。
     */
    public ?TagAssociation $tags = null;
}
