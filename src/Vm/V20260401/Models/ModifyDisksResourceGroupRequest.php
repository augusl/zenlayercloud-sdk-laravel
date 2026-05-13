<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyDisksResourceGroupRequest extends AbstractModel
{
    /**
     * DiskIds 云硬盘ID列表。
     * 每次请求允许操作的云硬盘数量上限是100。
     */
    public ?array $diskIds = null;

    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;
}
