<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeDiskCategoryResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * CategoryZoneSet 云硬盘类型与可用区关系结果集。
     *
     * @var DiskCategory[]|null
     */
    public ?array $categoryZoneSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'categoryZoneSet' => DiskCategory::class,
    ];
}
