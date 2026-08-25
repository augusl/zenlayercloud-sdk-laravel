<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Zec\V20250901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

class DescribeEipsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 满足过滤条件的EIP总数。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 返回的EIP列表。
     *
     * @var list<EipInfo>|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => EipInfo::class,
    ];
}
