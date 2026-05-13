<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribePolicyRegionsResponseParams
 */
class DescribePolicyRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Regions 区域可选列表。
     *
     * @var PolicyRegion[]|null
     */
    public ?array $regions = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regions' => PolicyRegion::class,
    ];
}
