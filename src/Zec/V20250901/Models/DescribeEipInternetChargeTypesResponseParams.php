<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeEipInternetChargeTypesResponseParams
 */
class DescribeEipInternetChargeTypesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InternetChargeTypes IP支持的网络计费方式。
     */
    public ?array $internetChargeTypes = null;
}
