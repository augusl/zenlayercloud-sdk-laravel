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
 * DeleteImageCopyRequest
 */
class DeleteImageCopyRequest extends AbstractModel
{
    /**
     * ImageId 自定义镜像ID。
     * 可通过调用 ~~DescribeImages~~ 获取。
     */
    public ?string $imageId = null;

    /**
     * RegionIds 待删除副本的区域ID列表。
     * 可通过调用 ~~DescribeRegions~~ 获取。
     *
     * @var list<string>|null
     */
    public ?array $regionIds = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'regionIds' => 'string',
    ];
}
