<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateBorderGatewayResponseParams
 */
class CreateBorderGatewayResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ZbgId 边界网关的ID。
     */
    public ?string $zbgId = null;
}
