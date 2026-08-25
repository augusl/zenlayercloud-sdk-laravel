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
 * DescribeZoneInstanceConfigInfosResponseParams
 */
class DescribeZoneInstanceConfigInfosResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceTypeQuotaSet 实例规格信息。
     *
     * @var list<InstanceTypeQuotaItem>|null
     */
    public ?array $instanceTypeQuotaSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'instanceTypeQuotaSet' => InstanceTypeQuotaItem::class,
    ];
}
