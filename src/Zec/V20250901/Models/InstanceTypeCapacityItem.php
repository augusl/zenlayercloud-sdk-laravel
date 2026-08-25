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
 * InstanceTypeCapacityItem 实例类型库存容量明细。
 */
class InstanceTypeCapacityItem extends AbstractModel
{
    /**
     * InstanceType CPU 实例类型，如 z2a、z2i、z4a。
     */
    public ?string $instanceType = null;

    /**
     * GpuSpec GPU 型号，如 z4a.g.C49。
     * 仅 GPU 实例返回此字段。
     */
    public ?string $gpuSpec = null;

    /**
     * Capacity 该实例类型的库存容量级别。
     * 库存容量根据所有机型可售核数定义，不包含内存、存储或其他资源因素。
     */
    public ?string $capacity = null;
}
