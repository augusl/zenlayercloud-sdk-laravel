<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeDDosEventDetailRequest
 */
class DescribeDDosEventDetailRequest extends AbstractModel
{
    /**
     * EventId 攻击事件唯一ID。
     */
    public ?string $eventId = null;

    /**
     * RegionId 区域节点ID。
     */
    public ?string $regionId = null;
}
