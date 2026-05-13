<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDiskCategoryResponseParams
 */
class DescribeDiskCategoryResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * CategoryZoneSet 可用区支持的云盘类型。
     *
     * @var DescribeDiskCategoryItem[]|null
     */
    public ?array $categoryZoneSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'categoryZoneSet' => DescribeDiskCategoryItem::class,
    ];
}
