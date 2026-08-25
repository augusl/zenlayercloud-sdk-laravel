<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

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
     * ImageSize 镜像的大小，单位GiB。
     * 当镜像为自定义镜像时此字段可能为null，当镜像状态处于`AVAILABLE`后有值。
     */
    public ?string $imageSize = null;

    /**
     * MinDiskSize 创建实例系统盘所需最小容量，单位GiB。
     */
    public ?int $minDiskSize = null;

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
     *
     * @var list<string>|null
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

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'nicNetworkType' => 'string',
    ];
}
