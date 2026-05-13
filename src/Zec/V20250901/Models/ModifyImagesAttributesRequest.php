<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class ModifyImagesAttributesRequest extends AbstractModel
{
    /**
     * ImageIds 待修改属性的镜像ID列表。
     */
    public ?array $imageIds = null;

    /**
     * ImageName 名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $imageName = null;
}
