<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeAvailableNatsRequest
 */
class DescribeAvailableNatsRequest extends AbstractModel
{
    /**
     * ZbgId 要查询需要绑定的边界网关ID。
     */
    public ?string $zbgId = null;
}
