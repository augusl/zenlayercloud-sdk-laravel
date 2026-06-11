<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeImageCopyProgressRequest extends AbstractModel
{
    /**
     * ImageId 自定义镜像 ID。
     */
    public ?string $imageId = null;
}
