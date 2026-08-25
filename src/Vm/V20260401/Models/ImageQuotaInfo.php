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
 * ImageQuotaInfo 镜像的配额信息。
 */
class ImageQuotaInfo extends AbstractModel
{
    /**
     * ZoneId 支持创建镜像的区域。
     */
    public ?string $zoneId = null;

    /**
     * Count 当前已配置镜像数。
     */
    public ?int $count = null;

    /**
     * MaxCount 本区域可配置的最大镜像数。
     */
    public ?int $maxCount = null;
}
