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
 * VmRegionCapacityItem 节点库存容量信息。
 */
class VmRegionCapacityItem extends AbstractModel
{
    /**
     * RegionId 节点 ID，格式如 asia-north-1。
     */
    public ?string $regionId = null;

    /**
     * Capacity 该节点整体库存容量级别。
     * 库存容量根据所有机型可售核数定义，不包含内存、存储或其他资源因素。
     */
    public ?string $capacity = null;

    /**
     * InstanceTypes 各实例类型的库存容量明细，不含库存为 0 的条目。
     *
     * @var list<InstanceTypeCapacityItem>|null
     */
    public ?array $instanceTypes = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'instanceTypes' => InstanceTypeCapacityItem::class,
    ];
}
