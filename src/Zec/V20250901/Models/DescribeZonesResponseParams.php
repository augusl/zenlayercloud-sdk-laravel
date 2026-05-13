<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeZonesResponseParams
 */
class DescribeZonesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ZoneSet 可用区列表。
     *
     * @var ZoneInfo[]|null
     */
    public ?array $zoneSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'zoneSet' => ZoneInfo::class,
    ];
}
