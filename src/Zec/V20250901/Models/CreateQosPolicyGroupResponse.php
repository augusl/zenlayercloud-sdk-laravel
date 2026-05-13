<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateQosPolicyGroupResponse extends AbstractModel
{
    public ?string $requestId = null;

    public ?CreateQosPolicyGroupResponseParams $response = null;
}
