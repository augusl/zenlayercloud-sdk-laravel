<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ConfigEipEgressIpRequest
 */
class ConfigEipEgressIpRequest extends AbstractModel
{
    /**
     * EipId 要作为出口的公网弹性IP。
     */
    public ?string $eipId = null;
}
