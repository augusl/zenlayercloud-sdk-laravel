<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateEipsResponseParams
 */
class CreateEipsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * EipIds 创建的弹性公网IP ID列表。
     */
    public ?array $eipIds = null;

    /**
     * OrderNumber 本次创建的订单编号。
     */
    public ?string $orderNumber = null;
}
