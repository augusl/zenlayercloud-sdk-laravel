<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ByoipPriceItem BYOIP 询价单项。
 */
class ByoipPriceItem extends AbstractModel
{
    /**
     * CidrBlock 宣告ip段。
     */
    public ?string $cidrBlock = null;

    /**
     * NetworkType 线路类型。
     */
    public ?string $networkType = null;

    /**
     * RegionId 区域id。
     */
    public ?string $regionId = null;
}
