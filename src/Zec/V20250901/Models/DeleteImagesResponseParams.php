<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteImagesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ImageIds 操作失败的镜像ID列表。
     */
    public ?array $imageIds = null;
}
