<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateDisksResponseParams
 */
class CreateDisksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DiskIds 创建的云硬盘ID列表。
     */
    public ?array $diskIds = null;

    /**
     * OrderNumber 本次创建对应的订单编号。
     */
    public ?string $orderNumber = null;
}
