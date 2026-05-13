<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ResetInstancePasswordRequest
 */
class ResetInstancePasswordRequest extends AbstractModel
{
    /**
     * InstanceId 待操作的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * Password 密码。
     * 必须是8-16位。
     * 必须包含以下3种格式的字符：大小写字母: [a-zA-Z]数字: 0-9特殊字符: ~!@$^*-_=+。
     */
    public ?string $password = null;
}
