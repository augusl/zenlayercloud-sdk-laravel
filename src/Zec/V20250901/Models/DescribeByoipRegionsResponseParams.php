<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeByoipRegionsResponseParams
 */
class DescribeByoipRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Regions 支持售卖 BYOIP 的区域列表。
     *
     * @var Region[]|null
     */
    public ?array $regions = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regions' => Region::class,
    ];
}
