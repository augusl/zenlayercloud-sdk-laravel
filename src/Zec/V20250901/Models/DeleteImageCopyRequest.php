<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteImageCopyRequest extends AbstractModel
{
    /**
     * ImageId 自定义镜像 ID。
     */
    public ?string $imageId = null;

    /**
     * RegionIds 待删除副本的区域 ID 列表。
     */
    public ?array $regionIds = null;
}
