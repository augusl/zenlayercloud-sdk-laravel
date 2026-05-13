<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ReplaceIp 替换的公网IP信息。
 */
class ReplaceIp extends AbstractModel
{
    /**
     * EipId 需要替换的弹性公网IP ID。
     */
    public ?string $eipId = null;

    /**
     * OwnIp 原IP。
     * 当IP是三线IP(IP线路类型为`ThreeLine`)时需要指定。
     */
    public ?string $ownIp = null;

    /**
     * TargetIp 需要变更的目标IP。
     * 如果未指定，将由系统随机分配。
     */
    public ?string $targetIp = null;
}
