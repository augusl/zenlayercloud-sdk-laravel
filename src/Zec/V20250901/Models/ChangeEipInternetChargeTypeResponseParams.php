<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ChangeEipInternetChargeTypeResponseParams
 */
class ChangeEipInternetChargeTypeResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * OrderNumber 变更可能产生的订单号。
     */
    public ?string $orderNumber = null;
}
