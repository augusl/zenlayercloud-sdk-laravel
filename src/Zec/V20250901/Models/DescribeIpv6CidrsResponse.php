<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeIpv6CidrsResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?DescribeIpv6CidrsResponseParams $response = null;
}
