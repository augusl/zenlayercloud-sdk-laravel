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
 * DescribeZoneAcceleratorConfigInfosResponseParams
 */
class DescribeZoneAcceleratorConfigInfosResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * InstanceTypeQuotaSet 加速卡规格售卖信息列表。
     *
     * @var list<AcceleratorTypeQuotaItem>|null
     */
    public ?array $instanceTypeQuotaSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'instanceTypeQuotaSet' => AcceleratorTypeQuotaItem::class,
    ];
}
