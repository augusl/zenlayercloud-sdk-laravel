<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateDisksResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DiskIds 云硬盘ID集合。
     */
    public ?array $diskIds = null;

    /**
     * OrderNumber 订单编号。
     */
    public ?string $orderNumber = null;
}
