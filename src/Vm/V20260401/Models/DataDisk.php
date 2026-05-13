<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DataDisk 数据盘的基本信息。
 */
class DataDisk extends AbstractModel
{
    /**
     * DiskId 磁盘ID。
     */
    public ?string $diskId = null;

    /**
     * DiskName 磁盘名称。
     */
    public ?string $diskName = null;

    /**
     * DiskSize 数据盘大小，单位GB。
     */
    public ?int $diskSize = null;

    /**
     * DiskAmount 数据盘数量。
     */
    public ?int $diskAmount = null;

    /**
     * Portable 是否可拔插。
     */
    public ?bool $portable = null;

    /**
     * DiskCategory 磁盘种类。
     * STANDARD：标准云盘。
     * SSD：固态硬盘。
     * 默认为SSD。
     */
    public ?string $diskCategory = null;

    /**
     * DiskPrice 数据盘价格。
     */
    public ?PriceItem $diskPrice = null;
}
