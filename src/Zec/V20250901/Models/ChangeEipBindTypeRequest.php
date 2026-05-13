<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ChangeEipBindTypeRequest
 */
class ChangeEipBindTypeRequest extends AbstractModel
{
    /**
     * EipId 要更换绑定模式的EIP ID。
     */
    public ?string $eipId = null;

    /**
     * BindType 绑定类型。
     * 当绑定的是网卡时生效。
     * 默认为普通NAT模式。
     */
    public ?string $bindType = null;
}
