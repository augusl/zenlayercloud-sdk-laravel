<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DiskCategory 云盘类型。
 */
class DiskCategory extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * CategorySet 该可用区支持的云硬盘种类集合。
     */
    public ?array $categorySet = null;
}
