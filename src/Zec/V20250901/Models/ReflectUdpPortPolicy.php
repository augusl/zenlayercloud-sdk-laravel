<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ReflectUdpPortPolicy UDP反射源端口
 */
class ReflectUdpPortPolicy extends AbstractModel
{
    /**
     * Name 反射攻击类型。
     */
    public ?string $name = null;

    /**
     * Port 反射源端口。
     */
    public ?int $port = null;
}
