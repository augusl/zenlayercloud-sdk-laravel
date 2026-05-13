<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DdosReflectUdpPort DDoS 反射攻击相关信息。
 */
class DdosReflectUdpPort extends AbstractModel
{
    /**
     * Port 反射攻击防护过滤的端口。
     */
    public ?int $port = null;
}
