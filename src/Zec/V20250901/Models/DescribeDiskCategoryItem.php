<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDiskCategoryItem 描述可用区支持的云盘类型的信息。
 */
class DescribeDiskCategoryItem extends AbstractModel
{
    /**
     * ZoneId 可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * CategorySet 支持的云硬盘类型。
     */
    public ?array $categorySet = null;
}
