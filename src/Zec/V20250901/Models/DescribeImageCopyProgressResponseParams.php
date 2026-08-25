<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeImageCopyProgressResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataSet 镜像复制进度列表，仅包含进行中的目标区域。
     * 镜像状态非SYNCING时返回空列表。
     *
     * @var list<ImageCopyProgress>|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => ImageCopyProgress::class,
    ];
}
