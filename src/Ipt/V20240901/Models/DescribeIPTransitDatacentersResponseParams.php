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
 * DescribeIPTransitDatacentersResponseParams
 */
class DescribeIPTransitDatacentersResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * SupportSet 可连接数据中心结果集。
     *
     * @var list<IPTransitDatacenter>|null
     */
    public ?array $supportSet = null;

    /** @var array<string,class-string<AbstractModel>> */
    protected static array $_typeMap = [
        'supportSet' => IPTransitDatacenter::class,
    ];
}
