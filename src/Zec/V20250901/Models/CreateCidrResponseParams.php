<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * CreateCidrResponseParams
 */
class CreateCidrResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * CidrIds 创建的CIDR地址段ID列表。
     */
    public ?array $cidrIds = null;
}
