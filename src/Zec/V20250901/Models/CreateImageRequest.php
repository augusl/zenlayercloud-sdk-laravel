<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class CreateImageRequest extends AbstractModel
{
    /**
     * InstanceId 需要制作镜像的实例ID。
     */
    public ?string $instanceId = null;

    /**
     * ImageName 名称。
     * 范围2到63个字符。
     * 仅支持输入字母、数字、-/_和英文句点(.)。
     * 且必须以数字或字母开头和结尾。
     */
    public ?string $imageName = null;

    /**
     * ResourceGroupId 镜像所放的资源组ID，如不指定则放入默认资源组。
     */
    public ?string $resourceGroupId = null;

    /**
     * Tags 创建镜像时关联的标签。
     * 注意：·关联`标签键`不能重复。
     */
    public ?TagAssociation $tags = null;
}
