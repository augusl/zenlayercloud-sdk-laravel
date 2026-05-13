<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InquiryPriceCreateDisksRequest
 */
class InquiryPriceCreateDisksRequest extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * DiskSize 云硬盘大小。
     * 单位：GiB。
     */
    public ?int $diskSize = null;

    /**
     * DiskAmount 云硬盘数量。
     */
    public ?int $diskAmount = null;

    /**
     * DiskCategory 云硬盘种类。
     * Basic NVMe SSD: 经济型 NVMe SSD。
     * Standard NVMe SSD: 标准型 NVMe SSD。
     * 默认为Standard NVMe SSD。
     */
    public ?string $diskCategory = null;
}
