<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeImagesRequest extends AbstractModel
{
    /**
     * ImageIds 镜像ID集合。
     *
     * @var list<string>|null
     */
    public ?array $imageIds = null;

    /**
     * ImageName 镜像名称。
     */
    public ?string $imageName = null;

    /**
     * ZoneId 可用区ID。
     * 可从DescribeZones的zoneId中获取。
     */
    public ?string $zoneId = null;

    /**
     * Category 镜像所属分类。
     * 可能值：CentOS、Windows、Ubuntu、Debian。
     */
    public ?string $category = null;

    /**
     * ImageType 镜像类型。
     * PUBLIC_IMAGE：公共镜像。
     * CUSTOM_IMAGE：自定义镜像。
     */
    public ?string $imageType = null;

    /**
     * OsType 操作系统类型。
     * 可能值：windows、linux。
     */
    public ?string $osType = null;

    /**
     * ImageStatus 镜像状态。
     * CREATING：创建中。
     * AVAILABLE：可用。
     * UNAVAILABLE：不可用。
     */
    public ?string $imageStatus = null;

    /**
     * PageNum 返回的分页数。
     * 默认为1。
     */
    public ?int $pageNum = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'imageIds' => 'string',
    ];
}
