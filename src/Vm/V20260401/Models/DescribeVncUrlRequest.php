<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeVncUrlRequest
 */
class DescribeVncUrlRequest extends AbstractModel
{
    /**
     * InstanceId 要查询的实例ID。
     */
    public ?string $instanceId = null;
}
