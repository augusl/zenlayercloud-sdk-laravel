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
 * DescribePolicyRegionsResponseParams
 */
class DescribePolicyRegionsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Regions 区域可选列表。
     *
     * @var list<PolicyRegion>|null
     */
    public ?array $regions = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'regions' => PolicyRegion::class,
    ];
}
