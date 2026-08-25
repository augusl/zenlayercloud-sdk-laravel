<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * ImageInfo 镜像相关信息。
 */
class ImageInfo extends AbstractModel
{
    /**
     * ImageId 镜像ID。
     */
    public ?string $imageId = null;

    /**
     * ImageName 镜像名称。
     */
    public ?string $imageName = null;

    /**
     * ImageType 镜像类型。
     * PUBLIC_IMAGE：公共镜像。
     * CUSTOM_IMAGE：自定义镜像。
     */
    public ?string $imageType = null;

    /**
     * ImageSize 镜像大小，单位为GB。
     */
    public ?string $imageSize = null;

    /**
     * ImageDescription 镜像描述。
     */
    public ?string $imageDescription = null;

    /**
     * ImageVersion 镜像版本。
     */
    public ?string $imageVersion = null;

    /**
     * ImageStatus 镜像状态。
     * CREATING：创建中。
     * AVAILABLE：可用。
     * UNAVAILABLE：不可用。
     */
    public ?string $imageStatus = null;

    /**
     * Category 镜像所属分类。
     */
    public ?string $category = null;

    /**
     * OsType 操作系统类型。
     * 可能值：windows、linux。
     */
    public ?string $osType = null;
}
