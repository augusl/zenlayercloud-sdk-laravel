<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ModifyDisksResourceGroupRequest
 */
class ModifyDisksResourceGroupRequest extends AbstractModel
{
    /**
     * DiskIds 要迁移资源组的云盘ID列表。
     */
    public ?array $diskIds = null;

    /**
     * ResourceGroupId 目标资源组ID。
     */
    public ?string $resourceGroupId = null;
}
