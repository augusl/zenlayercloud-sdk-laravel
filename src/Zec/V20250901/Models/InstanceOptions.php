<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * InstanceOptions 描述实例选项相关配置。
 */
class InstanceOptions extends AbstractModel
{
    /**
     * NestedVirtualization 是否启用嵌套虚拟化。
     * 如果要开启嵌套虚拟化，需要联系Support开通,否则设置无效。
     */
    public ?bool $nestedVirtualization = null;
}
