<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeVncUrlResponseParams
 */
class DescribeVncUrlResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Url VNC地址URL。
     */
    public ?string $url = null;
}
