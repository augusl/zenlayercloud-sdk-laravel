<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Vm\V20260401\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeImageQuotaResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Images 镜像配额结果集。
     *
     * @var list<ImageQuotaInfo>|null
     */
    public ?array $images = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'images' => ImageQuotaInfo::class,
    ];
}
