<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyImagesAttributesRequest extends AbstractModel
{
    /**
     * ImageIds 镜像ID集合。
     * 可从DescribeImages返回的imageId获取。
     */
    public ?array $imageIds = null;

    /**
     * ImageDescription 新的镜像描述。
     * 描述信息不得超过255个字符。
     */
    public ?string $imageDescription = null;

    /**
     * ImageName 新的镜像名称。
     * 长度不超过24位，支持中文、字母、数字或连接符号-_。
     */
    public ?string $imageName = null;
}
