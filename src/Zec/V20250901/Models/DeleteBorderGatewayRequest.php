<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteBorderGatewayRequest
 */
class DeleteBorderGatewayRequest extends AbstractModel
{
    /**
     * ZbgId 要删除的边界网关ID。
     */
    public ?string $zbgId = null;
}
