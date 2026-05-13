<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyInstanceBandwidthRequest extends AbstractModel
{
    /**
     * InstanceId 待操作的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * InternetMaxBandwidthOut 出口带宽大小。
     */
    public ?int $internetMaxBandwidthOut = null;
}
