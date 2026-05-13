<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateQosPolicyGroupResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * QosPolicyGroupId 新建QoS策略组ID。
     */
    public ?string $qosPolicyGroupId = null;
}
