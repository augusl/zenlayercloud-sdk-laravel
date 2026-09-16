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
 * DescribeUsableByoAsnsResponseParams
 */
class DescribeUsableByoAsnsResponseParams extends AbstractModel
{
    public ?string $requestId = null;

    /**
     * Asns 可作为 BYOIP 起源ASN使用的ASN号列表。
     * 包含已通过归属验证的自带ASN，以及线下已授权给该账号的ASN。
     *
     * @var list<int>|null
     */
    public ?array $asns = null;

    /** @var array<string,'string'|'int'|'float'|'bool'> */
    protected static array $_scalarArrayTypeMap = [
        'asns' => 'int',
    ];
}
