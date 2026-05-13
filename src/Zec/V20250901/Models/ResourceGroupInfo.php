<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ResourceGroupInfo 描述资源所在资源组的相关信息，包括资源组名称和ID。
 */
class ResourceGroupInfo extends AbstractModel
{
    /**
     * ResourceGroupId 资源组ID。
     */
    public ?string $resourceGroupId = null;

    /**
     * ResourceGroupName 资源组名称。
     */
    public ?string $resourceGroupName = null;
}
