<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DeleteImagesRequest extends AbstractModel
{
    /**
     * ImageIds 将要被删除的镜像ID集合。
     */
    public ?array $imageIds = null;
}
