<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * Image 描述镜像的基本信息。
 */
class Image extends AbstractModel
{
    /**
     * ImageId 镜像ID。
     */
    public ?string $imageId = null;

    /**
     * ImageName 镜像的名称。
     */
    public ?string $imageName = null;

    /**
     * ImageType 镜像的类型。
     */
    public ?string $imageType = null;

    /**
     * ImageSource 镜像的来源。
     */
    public ?string $imageSource = null;

    /**
     * ImageSize 镜像的大小。
     */
    public ?string $imageSize = null;

    /**
     * ImageDescription 镜像描述信息。
     */
    public ?string $imageDescription = null;

    /**
     * ImageVersion 镜像的版本。
     */
    public ?string $imageVersion = null;

    /**
     * ImageStatus 镜像的状态。
     */
    public ?string $imageStatus = null;

    /**
     * NicNetworkType 镜像支持的网卡类型。
     */
    public ?array $nicNetworkType = null;

    /**
     * Category 镜像的分类。
     */
    public ?string $category = null;

    /**
     * OsType 操作系统类型。
     */
    public ?string $osType = null;

    /**
     * Tags 实例关联的标签。
     */
    public ?Tags $tags = null;
}
