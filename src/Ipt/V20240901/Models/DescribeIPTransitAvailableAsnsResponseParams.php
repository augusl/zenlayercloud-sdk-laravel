<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);

namespace ZenlayerCloud\Laravel\Ipt\V20240901\Models;

use ZenlayerCloud\Laravel\Common\AbstractModel;

/**
 * DescribeIPTransitAvailableAsnsResponseParams
 */
class DescribeIPTransitAvailableAsnsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * DataSet 可用 ASN 列表。
     *
     * @var list<AsnInfo>|null
     */
    public ?array $dataSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'dataSet' => AsnInfo::class,
    ];
}
