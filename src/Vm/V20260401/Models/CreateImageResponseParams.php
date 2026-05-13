<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateImageResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * ImageId 镜像ID。
     */
    public ?string $imageId = null;
}
