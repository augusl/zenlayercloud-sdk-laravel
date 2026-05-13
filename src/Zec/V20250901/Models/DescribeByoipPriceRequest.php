<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeByoipPriceRequest
 */
class DescribeByoipPriceRequest extends AbstractModel
{
    /**
     * ByoipList 待询价的 BYOIP 列表。
     *
     * @var ByoipPriceItem[]|null
     */
    public ?array $byoipList = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'byoipList' => ByoipPriceItem::class,
    ];
}
