<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeDiskCategoryRequest extends AbstractModel
{
    /**
     * InstanceChargeType 实例计费类型。
     * PREPAID：预付费，即包年包月。
     * POSTPAID：后付费。
     */
    public ?string $instanceChargeType = null;

    /**
     * ZoneId 可用区ID。
     * 可从DescribeZones接口中获取。
     */
    public ?string $zoneId = null;

    /**
     * DiskCategory 云硬盘种类。
     * STANDARD：标准云盘。
     * SSD：固态硬盘。
     */
    public ?string $diskCategory = null;
}
