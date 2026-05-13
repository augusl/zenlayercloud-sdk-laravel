<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeTimeZonesResponseParams
 */
class DescribeTimeZonesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TimeZones 所有的时区。
     */
    public ?array $timeZones = null;
}
