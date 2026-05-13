<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeAvailableNatsResponseParams
 */
class DescribeAvailableNatsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * NatIds 可以绑定边界网关的NAT ID集合。
     */
    public ?array $natIds = null;
}
