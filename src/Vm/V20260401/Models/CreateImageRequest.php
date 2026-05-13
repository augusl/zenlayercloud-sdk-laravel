<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateImageRequest extends AbstractModel
{
    /**
     * InstanceId 需要制作镜像的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * ImageName 镜像名称。
     * 长度不超过24位，支持中文、字母、数字或连接符号-_。
     */
    public ?string $imageName = null;

    /**
     * ImageDescription 镜像描述。
     * 不超过255个字符。
     */
    public ?string $imageDescription = null;
}
