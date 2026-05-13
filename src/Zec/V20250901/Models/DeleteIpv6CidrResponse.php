<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteIpv6CidrResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?DeleteIpv6CidrResponseParams $response = null;
}
