<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class InquiryPriceCreateDisksRequest extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     * 可从DescribeZones接口中获取。
     */
    public ?string $zoneId = null;

    /**
     * DiskSize 云硬盘大小，单位GB。
     */
    public ?int $diskSize = null;

    /**
     * DiskAmount 云硬盘数量。
     * 最小值与默认值均为1，最大值50。
     */
    public ?int $diskAmount = null;

    /**
     * ChargeType 付费类型。
     * PREPAID：预付费，即包年包月。
     * POSTPAID：后付费。
     */
    public ?string $chargeType = null;

    /**
     * ChargePrepaid 预付费模式，即包年包月相关参数设置。
     * 若指定云硬盘的付费类型为预付费则该参数必传。
     */
    public ?ChargePrepaid $chargePrepaid = null;

    /**
     * DiskCategory 云硬盘种类。
     * STANDARD：标准云盘。
     * SSD：固态硬盘。
     * 默认为SSD。
     */
    public ?string $diskCategory = null;
}
