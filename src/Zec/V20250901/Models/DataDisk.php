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
 * DataDisk 描述了数据盘的信息。
 */
class DataDisk extends AbstractModel
{
    /**
     * DiskId 数据盘ID。
     * 该参数仅作为 **DescribeInstances** 等查询类接口的返回参数，不可用于 **CreateZecInstances** 等写接口的入参。
     */
    public ?string $diskId = null;

    /**
     * DiskName 云盘的名称。
     * 该参数仅作为 **DescribeInstances** 等查询类接口的返回参数。
     */
    public ?string $diskName = null;

    /**
     * DiskSize 数据盘大小。
     * 单位：GiB。
     */
    public ?int $diskSize = null;

    /**
     * DiskAmount 数据盘数量。
     * 该参数仅用于 **CreateZecInstances**、**InquiryPriceCreateInstance** 等接口的入参。
     */
    public ?int $diskAmount = null;

    /**
     * Portable 云硬盘是否可卸载。
     * 该参数仅作为查询类接口的返回参数，不用于入参。
     * `true`：不随实例删除而删除；`false`：随实例删除而删除。
     */
    public ?bool $portable = null;

    /**
     * BurstingEnabled 是否开启性能突发。
     */
    public ?bool $burstingEnabled = null;

    /**
     * DiskCategory 云硬盘种类。
     * Basic NVMe SSD: 经济型NVMe SSD。
     * Standard NVMe SSD: 标准型NVMe SSD。
     */
    public ?string $diskCategory = null;
}
