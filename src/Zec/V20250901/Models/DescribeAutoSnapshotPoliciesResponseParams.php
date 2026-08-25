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
 * DescribeAutoSnapshotPoliciesResponseParams
 */
class DescribeAutoSnapshotPoliciesResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataSet 查询的自动快照策略数据结果。
     *
     * @var list<AutoSnapshotPolicy>|null
     */
    public ?array $dataSet = null;

    /**
     * TotalCount 符合匹配的总数量。
     */
    public ?int $totalCount = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => AutoSnapshotPolicy::class,
    ];
}
