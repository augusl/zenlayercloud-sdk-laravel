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
 * DescribeDDosAllEventListResponseParams
 */
class DescribeDDosAllEventListResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * TotalCount 符合条件的数据总数。
     */
    public ?int $totalCount = null;

    /**
     * DataSet 攻击事件列表的数据。
     *
     * @var list<AttackEventInfo>|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => AttackEventInfo::class,
    ];
}
