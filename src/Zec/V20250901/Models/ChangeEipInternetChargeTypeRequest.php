<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ChangeEipInternetChargeTypeRequest
 */
class ChangeEipInternetChargeTypeRequest extends AbstractModel
{
    /**
     * EipId 要操作的公网弹性IP。
     */
    public ?string $eipId = null;

    /**
     * InternetChargeType 要变更的目标网络计费类型。
     */
    public ?string $internetChargeType = null;

    /**
     * ClusterId 共享带宽包ID。
     * 如果要变更为共享带宽包计费，则需要指定。
     */
    public ?string $clusterId = null;
}
