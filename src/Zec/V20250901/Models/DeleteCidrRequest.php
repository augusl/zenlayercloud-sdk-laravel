<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DeleteCidrRequest
 */
class DeleteCidrRequest extends AbstractModel
{
    /**
     * CidrId 要删除的CIDR ID。
     */
    public ?string $cidrId = null;
}
