<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyInstanceTypeRequest
 */
class ModifyInstanceTypeRequest extends AbstractModel
{
    /**
     * InstanceId 要变更的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InstanceType 变更的目标实例规格。
     */
    public ?string $instanceType = null;
}
