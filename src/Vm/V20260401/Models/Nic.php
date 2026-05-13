<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * Nic 网络接口卡配置，包括公网和内网网卡名称设置。
 */
class Nic extends AbstractModel
{
    /**
     * WanName 公网网卡名称。
     */
    public ?string $wanName = null;

    /**
     * LanName 内网网卡名称。
     */
    public ?string $lanName = null;
}
