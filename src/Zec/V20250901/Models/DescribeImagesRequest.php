<?php

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeImagesRequest
 */
class DescribeImagesRequest extends AbstractModel
{
    /**
     * ZoneId 查询镜像所在的可用区ID。
     */
    public ?string $zoneId = null;

    /**
     * ImageIds 镜像ID列表。
     */
    public ?array $imageIds = null;

    /**
     * ImageName 根据镜像名称过滤。
     * 该字段支持模糊搜索。
     */
    public ?string $imageName = null;

    /**
     * Category 镜像所属分类。
     */
    public ?string $category = null;

    /**
     * ImageType 镜像类型。
     */
    public ?string $imageType = null;

    /**
     * ImageSource 镜像来源。
     */
    public ?string $imageSource = null;

    /**
     * OsType 操作系统类型。
     */
    public ?string $osType = null;

    /**
     * ImageStatus 镜像的状态。
     */
    public ?string $imageStatus = null;

    /**
     * PageNum 返回的分页页码。
     */
    public ?int $pageNum = null;

    /**
     * PageSize 返回的分页大小。
     * 默认为20，最大为1000。
     */
    public ?int $pageSize = null;

    /**
     * TagKeys 根据标签键进行搜索。
     * 最长不得超过20个标签键。
     */
    public ?array $tagKeys = null;

    /**
     * Tags 根据标签进行搜索。
     * 最长不得超过20个标签。
     *
     * @var Tag[]|null
     */
    public ?array $tags = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'tags' => Tag::class,
    ];
}
