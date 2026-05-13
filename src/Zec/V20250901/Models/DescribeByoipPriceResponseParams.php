<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeByoipPriceResponseParams
 */
class DescribeByoipPriceResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ByoipPrices BYOIP 价格列表。
     *
     * @var PriceItem[]|null
     */
    public ?array $byoipPrices = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'byoipPrices' => PriceItem::class,
    ];
}
